<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Commands\Feed
{
    use Timetabio\API\DataStore\DataStoreWriter;
    use Timetabio\API\Services\FeedService;

    class SetFeedVanityCommand
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

        public function execute(string $feedId, string $vanity)
        {
            $this->dataStoreWriter->removeVanity($feedId);

            if ($vanity === '') {
                $this->feedService->deleteFeedVanity($feedId);
                return;
            }

            $this->feedService->createFeedVanity($feedId, $vanity);
            $this->dataStoreWriter->setVanity($feedId, $vanity);
        }
    }
}
