<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Worker\Runners
{
    use Timetabio\Library\Tasks\IndexPostsTask;
    use Timetabio\Library\Tasks\TaskInterface;
    use Timetabio\Worker\DataStore\DataStoreWriter;
    use Timetabio\Worker\Services\PostService;

    class IndexPostsRunner implements RunnerInterface
    {
        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        /**
         * @var PostService
         */
        private $postService;

        public function __construct(DataStoreWriter $dataStoreWriter, PostService $postService)
        {
            $this->dataStoreWriter = $dataStoreWriter;
            $this->postService = $postService;
        }

        public function run(TaskInterface $task)
        {
            if (!$task instanceof IndexPostsTask) {
                return;
            }

            $posts = $this->postService->getPostIds();

            foreach ($posts as $post) {
                $this->dataStoreWriter->queueTask(new \Timetabio\Library\Tasks\IndexPostTask($post));
            }
        }
    }
}
