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
    class Password
    {
        /**
         * @var string
         */
        private $password;

        public function __construct(string $password)
        {
            $length = strlen($password);

            if ($length < 8 || $length > 72) {
                throw new \Exception('password must be between 8 and 72 characters');
            }

            $this->password = $password;
        }

        public function verify(string $hash): bool
        {
            return password_verify($this->password, $hash);
        }

        public function __toString(): string
        {
            return $this->password;
        }
    }
}
