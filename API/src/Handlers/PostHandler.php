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
    use Timetabio\API\DataStore\DataStoreWriter;
    use Timetabio\API\Models\APIModel;
    use Timetabio\Framework\Handlers\PostHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class PostHandler implements PostHandlerInterface
    {
        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        public function __construct(DataStoreWriter $dataStoreWriter)
        {
            $this->dataStoreWriter = $dataStoreWriter;
        }

        public function execute(AbstractModel $model)
        {
            /** @var APIModel $model */

            if (!$model->hasAccessToken()) {
                return;
            }

            $accessToken = $model->getAccessToken();

            if (!$accessToken->getAutoRenew()) {
                return;
            }

            $this->dataStoreWriter->renewAccessToken($accessToken);
        }
    }
}
