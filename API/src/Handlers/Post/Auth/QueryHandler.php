<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Post\Auth
{
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\AuthModel;
    use Timetabio\API\Queries\User\FetchAuthUserQuery;
    use Timetabio\API\ValueObjects\UserId;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchAuthUserQuery
         */
        private $fetchAuthUserQuery;

        public function __construct(FetchAuthUserQuery $fetchAuthUserQuery)
        {
            $this->fetchAuthUserQuery = $fetchAuthUserQuery;
        }

        public function execute(AbstractModel $model)
        {
            /** @var AuthModel $model */

            $user = $this->fetchAuthUserQuery->execute($model->getUser());

            if ($user === null) {
                throw new BadRequest('invalid login', 'invalid_login');
            }

            if (!password_verify($model->getPassword(), $user['password'])) {
                throw new BadRequest('invalid login', 'invalid_login');
            }

            if (!$user['is_verified']) {
                throw new BadRequest('user is not verified', 'user_not_verified');
            }

            $model->setAuthUserId(new UserId($user['id']));
        }
    }
}
