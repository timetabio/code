<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
