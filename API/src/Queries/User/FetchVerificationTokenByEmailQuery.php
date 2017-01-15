<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Queries\User
{
    use Timetabio\API\Services\UserService;
    use Timetabio\Framework\ValueObjects\EmailAddress;

    class FetchVerificationTokenByEmailQuery
    {
        /**
         * @var UserService
         */
        private $userService;

        public function __construct(UserService $userService)
        {
            $this->userService = $userService;
        }

        public function execute(EmailAddress $token)
        {
            return $this->userService->getVerificationTokenByEmail($token);
        }
    }
}