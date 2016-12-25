<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\ValueObjects
{
    class Username implements \JsonSerializable
    {
        /**
         * @var string
         */
        private $username;

        public function __construct(string $username)
        {
            $length = mb_strlen($username);

            if ($length < 3 || $length > 20) {
                throw new \Exception('username must be between 3 and 20 characters long');
            }

            if (!preg_match('/^[\w-]+$/u', $username)) {
                throw new \Exception('invalid username');
            }

            $this->username = $username;
        }

        public function __toString(): string
        {
            return $this->username;
        }

        public function jsonSerialize(): string
        {
            return $this->username;
        }
    }
}
