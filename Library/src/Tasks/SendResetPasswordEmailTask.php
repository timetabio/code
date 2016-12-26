<?php
/**
 * Copyright (c) 2016 Manuel Lopez <manuel.lopez@stud.bbbaden.ch>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Library\Tasks
{
    class SendResetPasswordEmailTask implements TaskInterface
    {
        /**
         * @var string
         */
        private $token;

        /**
         * @var string
         */
        private $userId;

        public function __construct(string $token, string $userId)
        {
            $this->token = $token;
            $this->userId = $userId;
        }

        public function getUserId(): string
        {
            return $this->userId;
        }

        public function getToken(): string
        {
            return $this->token;
        }

        public function getPriority(): \Timetabio\Library\TaskPriorities\Priority
        {
            return new \Timetabio\Library\TaskPriorities\High;
        }
    }
}
