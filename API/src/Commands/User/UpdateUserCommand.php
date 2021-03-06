<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Commands\User
{
    use Timetabio\API\Services\UserService;
    use Timetabio\API\ValueObjects\UserId;

    class UpdateUserCommand
    {
        /**
         * @var UserService
         */
        private $userService;

        public function __construct(UserService $userService)
        {
            $this->userService = $userService;
        }

        public function execute(UserId $userId, array $data)
        {
            $this->userService->updateUser($userId, $data);
        }
    }
}
