<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Worker\Runners
{
    use Timetabio\Library\Tasks\IndexFeedsTask;
    use Timetabio\Library\Tasks\TaskInterface;
    use Timetabio\Worker\DataStore\DataStoreWriter;
    use Timetabio\Worker\Services\FeedService;

    class IndexFeedsRunner implements RunnerInterface
    {
        /**
         * @var FeedService
         */
        private $feedService;

        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        public function __construct(FeedService $feedService, DataStoreWriter $dataStoreWriter)
        {
            $this->feedService = $feedService;
            $this->dataStoreWriter = $dataStoreWriter;
        }

        public function run(TaskInterface $task)
        {
            if (!$task instanceof IndexFeedsTask) {
                return;
            }

            foreach ($this->feedService->getFeedIds() as $feed) {
                $this->dataStoreWriter->queueTask(new \Timetabio\Library\Tasks\IndexFeedTask($feed));
            }
        }
    }
}
