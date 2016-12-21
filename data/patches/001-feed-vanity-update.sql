CREATE TRIGGER update_feed_vanities_timestamp_column BEFORE UPDATE ON feed_vanities FOR EACH ROW EXECUTE PROCEDURE update_timestamp_column();
