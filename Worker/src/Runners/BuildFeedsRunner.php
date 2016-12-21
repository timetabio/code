<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Worker\Runners
{
    use Timetabio\Library\Tasks\BuildFeedsTask;
    use Timetabio\Library\Tasks\TaskInterface;
    use Timetabio\Worker\DataStore\DataStoreWriter;
    use Timetabio\Worker\Services\FeedService;

    class BuildFeedsRunner implements RunnerInterface
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
            if (!$task instanceof BuildFeedsTask) {
                return;
            }

            foreach ($this->feedService->getFeedIds() as $feed) {
                $this->dataStoreWriter->queueTask(new \Timetabio\Library\Tasks\BuildFeedTask($feed));
            }
        }
    }
}
