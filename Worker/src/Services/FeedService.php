<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Worker\Services
{
    use Timetabio\Framework\Backends\PostgresBackend;

    class FeedService
    {
        /**
         * @var PostgresBackend
         */
        private $postgresBackend;

        public function __construct(PostgresBackend $postgresBackend)
        {
            $this->postgresBackend = $postgresBackend;
        }

        public function getFeedIds(): \Traversable
        {
            return $this->postgresBackend->fetchColumns('SELECT id FROM feeds');
        }

        public function getFullFeed(string $feedId)
        {
            return $this->postgresBackend->fetch(
                'SELECT feeds.*, feed_vanities.name AS vanity_name
                 FROM feeds
                 LEFT OUTER JOIN feed_vanities ON feeds.id = feed_vanities.feed_id
                 WHERE feeds.id = :id',
                [
                    'id' => $feedId
                ]
            );
        }

        public function getFeedUsers(string $feedId): array
        {
            return $this->postgresBackend->fetchAll(
                'SELECT * FROM feed_users WHERE feed_id = :feed_id',
                [
                    'feed_id' => $feedId
                ]
            );
        }

        public function getFeed(string $feedId)
        {
            return $this->postgresBackend->fetch(
                'SELECT * FROM feeds WHERE id = :id',
                [
                    'id' => $feedId
                ]
            );
        }

        public function getFeedPostIds(string $feedId): \Traversable
        {
            return $this->postgresBackend->fetchColumns(
                'SELECT id FROM posts WHERE feed_id = :id',
                [
                    'id' => $feedId
                ]
            );
        }
    }
}
