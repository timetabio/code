<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Queries\Feed
{
    use Timetabio\API\DataStore\DataStoreReader;

    class FetchFeedVanityQuery
    {
        /**
         * @var DataStoreReader
         */
        private $dataStoreReader;

        public function __construct(DataStoreReader $dataStoreReader)
        {
            $this->dataStoreReader = $dataStoreReader;
        }

        public function execute(string $feedId): ?string
        {
            return $this->dataStoreReader->getFeedVanity($feedId);
        }
    }
}
