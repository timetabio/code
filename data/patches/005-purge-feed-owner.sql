DROP VIEW public_feeds;
CREATE VIEW public_feeds AS
  SELECT feeds.id,
    feeds.name,
    feeds.is_verified,
    feeds.created,
    feeds.updated
  FROM feeds
  WHERE is_private = FALSE;

DROP VIEW aggregated_feeds;
CREATE VIEW aggregated_feeds AS
  SELECT *
  FROM feeds;

DROP INDEX feed_users_owner;
