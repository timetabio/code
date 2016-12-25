<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Factories
{
    use Timetabio\Framework\Curl\Credentials\BearerToken;
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class ApplicationFactory extends AbstractChildFactory
    {
        use FactoryTypeHintTrait;

        public function createDataStoreReader(): \Timetabio\Frontend\DataStore\DataStoreReader
        {
            return new \Timetabio\Frontend\DataStore\DataStoreReader(
                $this->getMasterFactory()->createRedisBackend()
            );
        }

        public function createDataStoreWriter(): \Timetabio\Frontend\DataStore\DataStoreWriter
        {
            return new \Timetabio\Frontend\DataStore\DataStoreWriter(
                $this->getMasterFactory()->createRedisBackend()
            );
        }

        public function createApiBackend(): \Timetabio\Frontend\Backends\ApiBackend
        {
            return new \Timetabio\Frontend\Backends\ApiBackend(
                $this->getMasterFactory()->createCurl(),
                $this->getMasterFactory()->getConfiguration()->get('apiUrl')
            );
        }

        public function createApiGateway(): \Timetabio\Frontend\Gateways\ApiGateway
        {
            return new \Timetabio\Frontend\Gateways\ApiGateway(
                $this->getMasterFactory()->createApiBackend(),
                $this->getMasterFactory()->createSession(),
                new BearerToken($this->getMasterFactory()->createDataStoreReader()->getSystemToken())
            );
        }
    }
}
