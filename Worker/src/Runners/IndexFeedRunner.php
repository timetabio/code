<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Worker\Runners
{
    use Timetabio\Library\Indexers\Indexer;
    use Timetabio\Library\Mappers\FeedMapper;
    use Timetabio\Library\Tasks\IndexFeedTask;
    use Timetabio\Library\Tasks\TaskInterface;
    use Timetabio\Worker\DataStore\DataStoreWriter;
    use Timetabio\Worker\Services\FeedService;

    class IndexFeedRunner implements RunnerInterface
    {
        /**
         * @var FeedService
         */
        private $feedService;

        /**
         * @var FeedMapper
         */
        private $feedMapper;

        /**
         * @var Indexer
         */
        private $indexer;

        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        public function __construct(FeedService $feedService, FeedMapper $feedMapper, Indexer $indexer, DataStoreWriter $dataStoreWriter)
        {
            $this->feedService = $feedService;
            $this->feedMapper = $feedMapper;
            $this->indexer = $indexer;
            $this->dataStoreWriter = $dataStoreWriter;
        }

        public function run(TaskInterface $task)
        {
            if (!$task instanceof IndexFeedTask) {
                return;
            }

            $feedId = $task->getFeedId();
            $feed = $this->feedService->getFeed($feedId);

            if ($feed === null) {
                $this->indexer->deleteDocument($feedId);
                return;
            }

            $mapped = $this->feedMapper->map($feed);
            $this->indexer->indexDocument($feedId, $mapped);

            foreach ($this->feedService->getFeedPostIds($feedId) as $post) {
                $this->dataStoreWriter->queueTask(new \Timetabio\Library\Tasks\IndexPostTask($post));
            }
        }
    }
}
