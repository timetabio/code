<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers
{
    use Timetabio\API\DataStore\DataStoreReader;
    use Timetabio\API\Models\APIModel;
    use Timetabio\API\Readers\RequestTokenReader;
    use Timetabio\Framework\Handlers\PreHandlerInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class PreHandler implements PreHandlerInterface
    {
        /**
         * @var DataStoreReader
         */
        private $dataStoreReader;

        /**
         * @var RequestTokenReader
         */
        private $requestTokenReader;

        public function __construct(DataStoreReader $dataStoreReader, RequestTokenReader $requestTokenReader)
        {
            $this->dataStoreReader = $dataStoreReader;
            $this->requestTokenReader = $requestTokenReader;
        }

        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var APIModel $model */

            $token = $this->requestTokenReader->read($request);

            if ($token === null) {
                return;
            }

            if (!$this->dataStoreReader->hasAccessToken($token)) {
                return;
            }

            $accessToken = $this->dataStoreReader->getAccessToken($token);

            $model->setAccessToken($accessToken);

            if ($accessToken->hasUserId()) {
                $model->setAuthUserId($accessToken->getUserId());
            }
        }
    }
}
