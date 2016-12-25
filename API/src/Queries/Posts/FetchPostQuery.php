<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Queries\Posts
{
    use Timetabio\API\DataStore\DataStoreReader;
    use Timetabio\API\Services\PostService;

    class FetchPostQuery
    {
        /**
         * @var PostService
         */
        private $postService;

        /**
         * @var DataStoreReader
         */
        private $dataStoreReader;

        public function __construct(PostService $postService, DataStoreReader $dataStoreReader)
        {
            $this->postService = $postService;
            $this->dataStoreReader = $dataStoreReader;
        }

        public function execute(string $postId, string $userId = null)
        {
            $post = $this->fetch($postId, $userId);

            if ($post !== null) {
                $post['rendered_body'] = $this->dataStoreReader->getPostBody($postId);
            }

            return $post;
        }

        private function fetch(string $postId, string $userId = null)
        {
            if ($userId === null) {
                return $this->postService->getPost($postId);
            }

            return $this->postService->getPostForUser($postId, $userId);
        }
    }
}
