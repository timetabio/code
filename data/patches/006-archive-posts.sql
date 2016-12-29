ALTER TABLE posts ADD archived TIMESTAMP DEFAULT NULL;

CREATE INDEX IF NOT EXISTS posts_archived ON posts (archived);

CREATE VIEW archived_posts AS
  SELECT * FROM posts
  WHERE archived IS NOT NULL;

CREATE VIEW expired_archived_posts AS
  SELECT * FROM posts
  WHERE archived IS NOT NULL
    AND archived < (utc_now() - INTERVAL '30 days');

DROP VIEW aggregated_posts;
CREATE VIEW aggregated_posts AS
  SELECT posts.*,
    users.username as author_username,
    users.name as author_name,
    feeds.name as feed_name
  FROM posts
    JOIN users ON posts.author_id = users.id
    JOIN feeds ON posts.feed_id = feeds.id;
