<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\ValueObjects
{
    class EmailAddress implements \JsonSerializable
    {
        /**
         * @var string
         */
        private $email;

        public function __construct(string $email)
        {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new \Exception('invalid email address');
            }

            $this->email = $email;
        }

        public function jsonSerialize(): string
        {
            return (string) $this;
        }

        public function __toString(): string
        {
            return $this->email;
        }
    }
}
