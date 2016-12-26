ALTER TABLE feed_vanities ADD created TIMESTAMP NOT NULL DEFAULT utc_now();
ALTER TABLE feed_vanities ADD updated TIMESTAMP NOT NULL DEFAULT utc_now();
