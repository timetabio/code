<?php
/**
 * Copyright (c) 2016 Manuel Lopez <manuel.lopez@stud.bbbaden.ch>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Put\User
{
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\User\UpdateUserPasswordModel;
    use Timetabio\API\Queries\User\FetchUserPasswordQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchUserPasswordQuery
         */
        private $fetchUserPasswordQuery;

        public function __construct(FetchUserPasswordQuery $fetchUserPasswordQuery)
        {
            $this->fetchUserPasswordQuery = $fetchUserPasswordQuery;
        }

        public function execute(AbstractModel $model)
        {
            /** @var UpdateUserPasswordModel $model */

            $password = $this->fetchUserPasswordQuery->execute($model->getAuthUserId());

            if (!password_verify($model->getOldPassword(), $password)) {
                throw new BadRequest('invalid old password', 'invalid_old_password');
            }
        }
    }
}
