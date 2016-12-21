<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Commands\Posts
{
    use Timetabio\API\DataStore\DataStoreWriter;
    use Timetabio\API\Services\PostService;

    class DeletePostCommand
    {
        /**
         * @var PostService
         */
        private $postService;

        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        public function __construct(PostService $postService, DataStoreWriter $dataStoreWriter)
        {
            $this->postService = $postService;
            $this->dataStoreWriter = $dataStoreWriter;
        }

        public function execute(string $postId)
        {
            $this->postService->deletePost($postId);

            $this->dataStoreWriter->removePostBody($postId);
            $this->dataStoreWriter->removePostPreview($postId);
            $this->dataStoreWriter->removePostText($postId);

            $this->dataStoreWriter->queueTask(new \Timetabio\Library\Tasks\IndexPostTask($postId));
        }
    }
}
