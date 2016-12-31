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
    class ForgotPasswordModel extends APIModel
    {
        /**
         * @var string
         */
        private $user;

        /**
         * @var array
         */
        private $userData;

        public function getUser() : string
        {
            return $this->user;
        }

        public function setUser(string $user)
        {
            $this->user = $user;
        }

        public function hasUserData(): bool
        {
            return $this->userData !== null;
        }

        public function getUserData(): array
        {
            return $this->userData;
        }

        public function setUserData(array $userData)
        {
            $this->userData = $userData;
        }
    }
}
