<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Get\User
{
    use Timetabio\API\Models\APIModel;
    use Timetabio\API\Queries\User\FetchUserByIdQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Library\Mappers\DocumentMapper;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchUserByIdQuery
         */
        private $fetchUserByIdQuery;

        /**
         * @var DocumentMapper
         */
        private $userMapper;

        public function __construct(FetchUserByIdQuery $fetchUserByIdQuery, DocumentMapper $userMapper)
        {
            $this->fetchUserByIdQuery = $fetchUserByIdQuery;
            $this->userMapper = $userMapper;
        }

        public function execute(AbstractModel $model)
        {
            /** @var APIModel $model */

            $data = $this->fetchUserByIdQuery->execute(
                $model->getAuthUserId()
            );

            $user = $this->userMapper->map($data);

            $model->setData($user);
        }
    }
}
