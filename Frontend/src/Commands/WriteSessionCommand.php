<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Commands
{
    use Timetabio\Frontend\DataStore\DataStoreWriter;
    use Timetabio\Frontend\Session\Session;

    class WriteSessionCommand
    {
        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        public function __construct(DataStoreWriter $dataStoreWriter)
        {
            $this->dataStoreWriter = $dataStoreWriter;
        }

        public function execute(Session $session)
        {
            $this->dataStoreWriter->setSessionData($session->getSessionId(), $session->getData());
            $this->dataStoreWriter->expireSessionData($session->getSessionId(), $session->getExpires());
        }
    }
}
