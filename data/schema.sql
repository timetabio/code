CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

CREATE OR REPLACE FUNCTION update_timestamp_column()
RETURNS TRIGGER AS $$
BEGIN
  NEW.updated = utc_now();
  RETURN NEW;
END;
$$ LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION utc_now()
RETURNS TIMESTAMP as $$
BEGIN
  RETURN now() AT TIME ZONE 'UTC';
END;
$$ LANGUAGE 'plpgsql';

CREATE TABLE IF NOT EXISTS users (
  id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
  password VARCHAR(255) NOT NULL,
  is_verified BOOLEAN DEFAULT FALSE,
  username VARCHAR(255) NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  name VARCHAR(255) NOT NULL DEFAULT '',
  created TIMESTAMP NOT NULL DEFAULT utc_now(),
  updated TIMESTAMP NOT NULL DEFAULT utc_now()
);

CREATE UNIQUE INDEX users_lower_username ON users (lower(username));

CREATE TRIGGER update_users_timestamp_column BEFORE UPDATE ON users FOR EACH ROW EXECUTE PROCEDURE update_timestamp_column();

CREATE TABLE IF NOT EXISTS verification_tokens (
  id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
  token VARCHAR(255) NOT NULL,
  user_id UUID NOT NULL REFERENCES users (id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS feeds (
  id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
  name VARCHAR(255) NOT NULL DEFAULT '',
  description VARCHAR(255) NOT NULL DEFAULT '',
  is_private BOOLEAN NOT NULL,
  is_verified BOOLEAN DEFAULT FALSE,
  owner_id UUID REFERENCES users (id),
  created TIMESTAMP NOT NULL DEFAULT utc_now(),
  updated TIMESTAMP NOT NULL DEFAULT utc_now()
);

CREATE TRIGGER update_feeds_timestamp_column BEFORE UPDATE ON feeds FOR EACH ROW EXECUTE PROCEDURE update_timestamp_column();
CREATE INDEX IF NOT EXISTS feeds_owner_id ON feeds (owner_id);

CREATE TABLE feed_vanities (
  id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
  name VARCHAR(255) NOT NULL,
  feed_id UUID NOT NULL UNIQUE REFERENCES feeds (id)
);

CREATE UNIQUE INDEX feed_vanities_name ON feed_vanities (lower(name));
CREATE TRIGGER update_feed_vanities_timestamp_column BEFORE UPDATE ON feed_vanities FOR EACH ROW EXECUTE PROCEDURE update_timestamp_column();

CREATE VIEW public_feeds AS
  SELECT feeds.id,
    feeds.name,
    feeds.is_verified,
    feeds.created,
    feeds.updated,
    users.id AS owner_id,
    users.name AS owner_name,
    users.username AS owner_username
  FROM feeds
  JOIN feed_users
    ON feeds.id = feed_users.feed_id AND is_owner(feed_users.role)
  JOIN users
    ON feed_users.user_id = users.id
  WHERE is_private = FALSE;

CREATE TYPE post_type AS ENUM ('note', 'task', 'event');

CREATE TABLE IF NOT EXISTS posts (
  id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
  feed_id UUID NOT NULL REFERENCES feeds (id) ON DELETE CASCADE,
  author_id UUID NOT NULL REFERENCES users (id),
  type post_type DEFAULT 'note',
  title VARCHAR(255) NOT NULL DEFAULT '',
  body TEXT NOT NULL DEFAULT '',
  timestamp TIMESTAMP,
  created TIMESTAMP NOT NULL DEFAULT utc_now(),
  updated TIMESTAMP NOT NULL DEFAULT utc_now()
);

CREATE INDEX IF NOT EXISTS posts_feed_id ON posts (feed_id);
CREATE INDEX IF NOT EXISTS posts_timestamp ON posts (timestamp);
CREATE INDEX IF NOT EXISTS posts_type ON posts (type);
CREATE INDEX IF NOT EXISTS posts_type_timestamp ON posts (type, timestamp ASC);

CREATE VIEW aggregated_posts AS
  SELECT posts.*,
         users.username as author_username,
         users.name as author_name,
         feeds.name as feed_name
  FROM posts
  JOIN users ON posts.author_id = users.id
  JOIN feeds ON posts.feed_id = feeds.id;

-- TODO: define sorting (NOTE: timestamp might be null, so consider that as well)
CREATE VIEW uncompleted_tasks AS
  SELECT posts.*, feed_users.user_id
  FROM posts
  JOIN feed_users
    ON feed_users.feed_id = posts.feed_id
  LEFT OUTER JOIN post_annotations AS meta
    ON meta.post_id = posts.id
  WHERE posts.type = 'task'
    AND meta.is_checked IS NOT TRUE;

CREATE VIEW upcoming_events AS
  SELECT posts.*, feed_users.user_id FROM posts
  JOIN feed_users
    ON feed_users.feed_id = posts.feed_id
  WHERE posts.type = 'event'
    AND posts.timestamp > utc_now()
  ORDER BY posts.timestamp ASC;

CREATE TRIGGER update_posts_timestamp_column BEFORE UPDATE ON posts FOR EACH ROW EXECUTE PROCEDURE update_timestamp_column();

CREATE TABLE IF NOT EXISTS post_annotations (
  post_id UUID NOT NULL REFERENCES posts (id) ON DELETE CASCADE,
  user_id UUID NOT NULL REFERENCES users (id) ON DELETE CASCADE,
  is_checked BOOLEAN DEFAULT FALSE,
  PRIMARY KEY (post_id, user_id)
);

CREATE INDEX IF NOT EXISTS post_annotations_is_checked ON post_annotations (is_checked);

CREATE TABLE files (
  id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
  public_id VARCHAR(255) NOT NULL UNIQUE,
  owner_id UUID NOT NULL REFERENCES users (id),
  name VARCHAR(255),
  mime_type VARCHAR(255),
  created TIMESTAMP NOT NULL DEFAULT utc_now()
);

CREATE TABLE post_attachments (
  id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
  post_id UUID NOT NULL REFERENCES posts (id) ON DELETE CASCADE,
  file_id UUID NOT NULL REFERENCES files (id) ON DELETE CASCADE,
  created TIMESTAMP NOT NULL DEFAULT utc_now()
);

CREATE TYPE feed_user_role AS ENUM ('default', 'moderator', 'owner');
CREATE OR REPLACE FUNCTION is_owner(role feed_user_role)
RETURNS BOOLEAN AS
$$
BEGIN
  RETURN role >= 'owner'::feed_user_role;
END;
$$ LANGUAGE 'plpgsql';

CREATE TABLE IF NOT EXISTS feed_users (
  feed_id UUID NOT NULL REFERENCES feeds (id) ON DELETE CASCADE,
  user_id UUID NOT NULL REFERENCES users (id) ON DELETE CASCADE,
  role feed_user_role NOT NULL DEFAULT 'default'::feed_user_role,
  created TIMESTAMP NOT NULL DEFAULT utc_now(),
  updated TIMESTAMP NOT NULL DEFAULT utc_now(),
  PRIMARY KEY(feed_id, user_id)
);

CREATE INDEX feed_users_owner ON feed_users (feed_id, is_owner(role));

CREATE TRIGGER update_feed_users_timestamp_column BEFORE UPDATE ON feed_users FOR EACH ROW EXECUTE PROCEDURE update_timestamp_column();

CREATE VIEW aggregated_feeds AS
  SELECT feeds.*,
    users.id AS owner_id,
    users.username AS owner_username,
    users.name AS owner_name
  FROM feeds
  JOIN feed_users
    ON feeds.id = feed_users.feed_id AND is_owner(feed_users.role)
  JOIN users
    ON feed_users.user_id = users.id;

CREATE VIEW user_feeds AS
  SELECT feeds.*, feed_users.user_id
  FROM feeds
  JOIN feed_users
    ON feeds.id = feed_users.feed_id;

CREATE TABLE IF NOT EXISTS collections (
  id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
  name VARCHAR(255) NOT NULL DEFAULT '',
  owner_id UUID NOT NULL REFERENCES users (id),
  created TIMESTAMP NOT NULL DEFAULT utc_now(),
  updated TIMESTAMP NOT NULL DEFAULT utc_now()
);

CREATE TRIGGER update_collections_timestamp_column BEFORE UPDATE ON collections FOR EACH ROW EXECUTE PROCEDURE update_timestamp_column();
CREATE INDEX collections_owner_id ON collections (owner_id);

CREATE TABLE IF NOT EXISTS collection_posts (
  collection_id UUID NOT NULL REFERENCES collections (id),
  post_id UUID NOT NULL REFERENCES posts (id),
  PRIMARY KEY (collection_id, post_id)
);

CREATE TABLE beta_requests (
  id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
  created TIMESTAMP NOT NULL DEFAULT utc_now(),
  approved BOOLEAN NOT NULL DEFAULT FALSE,
  email VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE feed_invitations (
  feed_id UUID NOT NULL REFERENCES feeds (id) ON DELETE CASCADE,
  user_id UUID NOT NULL REFERENCES users (id) ON DELETE CASCADE,
  role feed_user_role NOT NULL DEFAULT 'default'::feed_user_role,
  created TIMESTAMP NOT NULL DEFAULT utc_now(),
  updated TIMESTAMP NOT NULL DEFAULT utc_now(),
  PRIMARY KEY(feed_id, user_id)
);

CREATE TRIGGER update_feed_invitations_timestamp BEFORE UPDATE ON feed_invitations FOR EACH ROW EXECUTE PROCEDURE update_timestamp_column();
