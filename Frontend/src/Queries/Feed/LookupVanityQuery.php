<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Queries\Feed
{
    use Timetabio\Frontend\DataStore\DataStoreReader;

    class LookupVanityQuery
    {
        /**
         * @var DataStoreReader
         */
        private $dataStoreReader;

        public function __construct(DataStoreReader $dataStoreReader)
        {
            $this->dataStoreReader = $dataStoreReader;
        }

        public function execute(string $vanity)
        {
            if ($this->dataStoreReader->hasVanity($vanity)) {
                return $this->dataStoreReader->getFeedByVanity($vanity);
            }

            return $vanity;
        }
    }
}
