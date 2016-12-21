<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Worker\Services
{
    use Timetabio\Framework\Backends\PostgresBackend;

    class UserService
    {
        /**
         * @var PostgresBackend
         */
        private $postgresBackend;

        public function __construct(PostgresBackend $postgresBackend)
        {
            $this->postgresBackend = $postgresBackend;
        }

        public function getUser(string $userId)
        {
            return $this->postgresBackend->fetch(
                'SELECT id, username, name, email FROM users WHERE id = :id',
                [
                    'id' => $userId
                ]
            );
        }

        public function getUserFeeds(string $userId): \Traversable
        {
            return $this->postgresBackend->fetchColumns(
                'SELECT feeds.id
                 FROM feed_users
                 JOIN feeds ON feed_users.feed_id = feeds.id
                 WHERE feed_users.user_id = :user_id',
                [
                    'user_id' => $userId
                ]
            );
        }

        public function getUserIds(): \Traversable
        {
            return $this->postgresBackend->fetchColumns('SELECT id FROM users');
        }
    }
}
