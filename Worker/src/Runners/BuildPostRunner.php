<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Worker\Runners
{
    use Timetabio\Framework\Backends\InkBackend;
    use Timetabio\Library\Tasks\BuildPostTask;
    use Timetabio\Library\Tasks\TaskInterface;
    use Timetabio\Worker\DataStore\DataStoreWriter;
    use Timetabio\Worker\Services\PostService;

    class BuildPostRunner implements RunnerInterface
    {
        /**
         * @var PostService
         */
        private $postService;

        /**
         * @var InkBackend
         */
        private $inkBackend;

        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        public function __construct(PostService $postService, InkBackend $inkBackend, DataStoreWriter $dataStoreWriter)
        {
            $this->postService = $postService;
            $this->inkBackend = $inkBackend;
            $this->dataStoreWriter = $dataStoreWriter;
        }

        public function run(TaskInterface $task)
        {
            if (!$task instanceof BuildPostTask) {
                return;
            }

            $post = $this->postService->getPostBody($task->getPostId());

            if ($post === null) {
                return;
            }

            $rendered = $this->inkBackend->process($post['body']);

            $this->dataStoreWriter->setPostBody($post['id'], $rendered->getBody());
            $this->dataStoreWriter->setPostPreview($post['id'], $rendered->getPreview());
            $this->dataStoreWriter->setPostText($post['id'], $rendered->getPlainText());
        }
    }
}
