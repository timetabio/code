<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Queries\Post
{
    use Timetabio\API\Services\PostService;

    class FetchPostAttachmentsQuery
    {
        /**
         * @var PostService
         */
        private $postService;

        public function __construct(PostService $postService)
        {
            $this->postService = $postService;
        }

        public function execute(string $postId)
        {
            return $this->postService->getPostAttachments($postId);
        }
    }
}
