<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Access
{
    use Timetabio\API\Access\AccessTypes\AccessTypeInterface;
    use Timetabio\API\Access\AccessTypes\NoAccess;
    use Timetabio\API\DataStore\DataStoreReader;
    use Timetabio\API\Endpoints\EndpointInterface;
    use Timetabio\API\Readers\RequestTokenReader;
    use Timetabio\Framework\Http\Request\RequestInterface;

    class AccessControl
    {
        /**
         * @var DataStoreReader
         */
        private $dataStoreReader;

        /**
         * @var RequestTokenReader
         */
        private $requestTokenReader;

        public function __construct(
            DataStoreReader $dataStoreReader,
            RequestTokenReader $requestTokenReader
        )
        {
            $this->dataStoreReader = $dataStoreReader;
            $this->requestTokenReader = $requestTokenReader;
        }

        public function hasAccess(RequestInterface $request, EndpointInterface $endpoint): bool
        {
            return $endpoint->hasAccess($this->getAccessType($request));
        }

        protected function getAccessType(RequestInterface $request): AccessTypeInterface
        {
            $token = $this->requestTokenReader->read($request);

            if ($token === null) {
                return new NoAccess;
            }

            if (!$this->dataStoreReader->hasAccessToken($token)) {
                return new NoAccess;
            }

            $accessToken = $this->dataStoreReader->getAccessToken($token);

            return $accessToken->getAccessType();
        }
    }
}
