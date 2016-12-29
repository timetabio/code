ALTER TABLE posts ADD archived TIMESTAMP DEFAULT NULL;

CREATE INDEX IF NOT EXISTS posts_archived ON posts (archived);

CREATE VIEW archived_posts AS
  SELECT * FROM posts
  WHERE archived IS NOT NULL;

CREATE VIEW expired_archived_posts AS
  SELECT * FROM posts
  WHERE archived IS NOT NULL
    AND archived < (utc_now() - INTERVAL '30 days');
