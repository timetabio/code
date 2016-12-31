<?php
/**
 * Copyright (c) 2016 Manuel Lopez <manuel.lopez@stud.bbbaden.ch>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Post\Forgot
{
    use Timetabio\API\Models\ForgotPasswordModel;
    use Timetabio\API\Queries\User\FetchAuthUserQuery;
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
            /** @var ForgotPasswordModel $model */

            $userId = $this->fetchAuthUserQuery->execute($model->getUser());

            if ($userId !== null) {
                $model->setUserData($userId);
            }

            $model->setData([
                'acknowledged' => true
            ]);
        }
    }
}
