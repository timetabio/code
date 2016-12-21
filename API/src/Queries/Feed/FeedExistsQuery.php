<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Queries\Feed
{
    use Timetabio\API\DataStore\DataStoreReader;

    class FeedExistsQuery
    {
        /**
         * @var DataStoreReader
         */
        private $dataStoreReader;

        public function __construct(DataStoreReader $dataStoreReader)
        {
            $this->dataStoreReader = $dataStoreReader;
        }

        public function execute(string $feedId)
        {
            return $this->dataStoreReader->hasFeed($feedId);
        }
    }
}
