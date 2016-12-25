<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\DataObjects
{
    use Timetabio\Library\ValueObjects\DisplayName;

    class User
    {
        /**
         * @var string
         */
        private $userId;

        /**
         * @var string
         */
        private $username;

        /**
         * @var string
         */
        private $name;

        public function __construct(string $userId, string $username, string $name = null)
        {
            $this->userId = $userId;
            $this->username = $username;
            $this->name = $name;
        }

        public function getUserId(): string
        {
            return $this->userId;
        }

        public function getUsername(): string
        {
            return $this->username;
        }

        public function getName()
        {
            return $this->name;
        }

        public function getDisplayName(): string
        {
            return new DisplayName([
                'name' => $this->name,
                'username' => $this->username
            ]);
        }
    }
}
