<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Worker\Services
{
    use Timetabio\Framework\Backends\PostgresBackend;

    class PostService
    {
        /**
         * @var PostgresBackend
         */
        private $postgresBackend;

        public function __construct(PostgresBackend $postgresBackend)
        {
            $this->postgresBackend = $postgresBackend;
        }

        public function getPostIds(): \Traversable
        {
            return $this->postgresBackend->fetchColumns('SELECT id FROM posts');
        }

        public function getPostBody(string $postId)
        {
            return $this->postgresBackend->fetch('SELECT id, body FROM posts WHERE id = :id', [
                'id' => $postId
            ]);
        }

        public function getPost(string $postId)
        {
            return $this->postgresBackend->fetch('SELECT * FROM aggregated_posts WHERE id = :id', [
                'id' => $postId
            ]);
        }
    }
}
