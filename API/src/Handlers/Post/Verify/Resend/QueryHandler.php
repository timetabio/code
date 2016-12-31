<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Post\Verify\Resend
{
    use Timetabio\API\Models\Verify\ResendModel;
    use Timetabio\API\Queries\User\FetchVerificationTokenByEmailQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Framework\ValueObjects\EmailPerson;
    use Timetabio\Framework\ValueObjects\Token;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchVerificationTokenByEmailQuery
         */
        private $fetchTokenQuery;

        public function __construct(FetchVerificationTokenByEmailQuery $fetchTokenQuery)
        {
            $this->fetchTokenQuery = $fetchTokenQuery;
        }

        public function execute(AbstractModel $model)
        {
            /** @var ResendModel $model */

            $email = $model->getEmail();

            $token = $this->fetchTokenQuery->execute($email);

            if ($token === null) {
                return;
            }

            $model->setEmailPerson(new EmailPerson($email));
            $model->setToken(new Token($token['token']));

            $model->setData([
                'queued' => true
            ]);
        }
    }
}
