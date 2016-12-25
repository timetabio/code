<?php
/**
 * Copyright (c) 2016 Manuel Lopez <manuel.lopez@stud.bbbaden.ch>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Post\Reset
{
    use Timetabio\API\DataStore\DataStoreReader;
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\ResetPasswordModel;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var DataStoreReader
         */
        private $dataStoreReader;

        public function __construct(DataStoreReader $dataStoreReader)
        {
            $this->dataStoreReader = $dataStoreReader;
        }

        public function execute(AbstractModel $model)
        {
            /** @var ResetPasswordModel $model */

            if(!$this->dataStoreReader->hasResetToken($model->getToken())) {
                throw new BadRequest('invalid token', 'invalid_token');
            }

            $model->setUserId($this->dataStoreReader->getResetToken($model->getToken()));
        }
    }
}
