<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
