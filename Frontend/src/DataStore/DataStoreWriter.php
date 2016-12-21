<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\DataStore
{
    use Timetabio\Framework\DataStore\DataStoreInterface;
    use Timetabio\Framework\Map\MapInterface;

    class DataStoreWriter
    {
        /**
         * @var DataStoreInterface
         */
        private $dataStore;

        public function __construct(DataStoreInterface $dataStore)
        {
            $this->dataStore = $dataStore;
        }

        public function setSessionData(string $sessionId, MapInterface $sessionData)
        {
            $this->dataStore->set('session_data_' . $sessionId, serialize($sessionData));
        }

        public function expireSessionData(string $sessionId, int $ttl)
        {
            $this->dataStore->setTimeout('session_data_' . $sessionId, $ttl);
        }
    }
}
