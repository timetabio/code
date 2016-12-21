<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Commands\Feeds
{
    use Timetabio\API\DataStore\DataStoreWriter;
    use Timetabio\API\Services\FeedService;
    use Timetabio\API\ValueObjects\FeedId;

    class UpdateFeedCommand
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

        public function execute(FeedId $feedId, array $updates)
        {
            $this->feedService->updateFeed($feedId, $updates);
            $this->dataStoreWriter->queueTask(new \Timetabio\Library\Tasks\IndexFeedTask($feedId));
        }
    }
}
