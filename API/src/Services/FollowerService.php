<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Services
{
    use Timetabio\Framework\Backends\PostgresBackend;

    class FollowerService
    {
        /**
         * @var PostgresBackend
         */
        private $databaseBackend;

        public function __construct(PostgresBackend $databaseBackend)
        {
            $this->databaseBackend = $databaseBackend;
        }

        public function getFollower(string $feedId, string $userId)
        {
            return $this->databaseBackend->fetch(
                'SELECT * FROM feed_users WHERE feed_id = :feed_id AND user_id = :user_id',
                [
                    'user_id' => $userId,
                    'feed_id' => $feedId
                ]
            );
        }

        public function followFeed(string $feedId, string $userId, string $role)
        {
            $this->databaseBackend->insert(
                'INSERT INTO feed_users(feed_id, user_id, role)
                 VALUES(:feed_id, :user_id, :role)
                 ON CONFLICT(feed_id, user_id) DO NOTHING',
                [
                    'feed_id' => $feedId,
                    'user_id' => $userId,
                    'role' => $role
                ]
            );
        }

        public function unfollowFeed(string $feedId, string $userId)
        {
            $this->databaseBackend->insert(
                'DELETE FROM feed_users
                 WHERE feed_id = :feed_id
                 AND user_id = :user_id',
                [
                    'feed_id' => $feedId,
                    'user_id' => $userId
                ]
            );
        }
    }
}
