<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Models\User
{
    use Timetabio\API\Models\APIModel;
    use Timetabio\API\ValueObjects\Password;
    use Timetabio\API\ValueObjects\Username;
    use Timetabio\Framework\ValueObjects\EmailAddress;

    class CreateModel extends APIModel
    {
        /**
         * @var EmailAddress
         */
        private $email;

        /**
         * @var Username
         */
        private $username;

        /**
         * @var Password
         */
        private $password;

        public function getEmail(): EmailAddress
        {
            return $this->email;
        }

        public function setEmail(EmailAddress $email)
        {
            $this->email = $email;
        }

        public function getUsername(): Username
        {
            return $this->username;
        }

        public function setUsername(Username $username)
        {
            $this->username = $username;
        }

        public function getPassword(): Password
        {
            return $this->password;
        }

        public function setPassword(Password $password)
        {
            $this->password = $password;
        }
    }
}
