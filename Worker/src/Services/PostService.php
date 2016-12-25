<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
