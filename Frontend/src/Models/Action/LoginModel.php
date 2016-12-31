<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Models\Action
{
    use Timetabio\Frontend\Models\ActionModel;
    use Timetabio\Frontend\ValueObjects\RedirectUri;

    class LoginModel extends ActionModel
    {
        /**
         * @var string
         */
        private $loginUser;

        /**
         * @var string
         */
        private $password;

        /**
         * @var RedirectUri
         */
        private $nextUri;

        public function getLoginUser(): string
        {
            return $this->loginUser;
        }

        public function setLoginUser(string $user)
        {
            $this->loginUser = $user;
        }

        public function getPassword(): string
        {
            return $this->password;
        }

        public function setPassword(string $password)
        {
            $this->password = $password;
        }

        public function getNextUri(): RedirectUri
        {
            return $this->nextUri;
        }

        public function setNextUri(RedirectUri $nextUri)
        {
            $this->nextUri = $nextUri;
        }
    }
}
