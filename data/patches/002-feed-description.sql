ALTER TABLE feeds ADD description VARCHAR(255) NOT NULL DEFAULT '';

DROP VIEW aggregated_feeds;
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

DROP VIEW user_feeds;
CREATE VIEW user_feeds AS
  SELECT feeds.*, feed_users.user_id
  FROM feeds
  JOIN feed_users
    ON feeds.id = feed_users.feed_id;