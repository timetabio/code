<?php
/**
 * Copyright (c) 2016 Manuel Lopez <manuel.lopez@stud.bbbaden.ch>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Models
{
    use Timetabio\API\ValueObjects\Password;

    class ResetPasswordModel extends APIModel
    {
        /**
         * @var Password
         */
        private $newPassword;

        /**
         * @return string
         */
        private $token;

        /**
         * @return string
         */
        private $userId;

        public function getNewPassword(): Password
        {
            return $this->newPassword;
        }

        public function setNewPassword(Password $newPassword)
        {
            $this->newPassword = $newPassword;
        }

        public function getToken() : string
        {
            return $this->token;
        }

        public function setToken(string $token)
        {
            $this->token = $token;
        }

        public function getUserId(): string
        {
            return $this->userId;
        }

        public function setUserId(string $userId)
        {
            $this->userId = $userId;
        }
    }
}
