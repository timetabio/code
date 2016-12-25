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
    class Token
    {
        /**
         * @var string
         */
        private $token;

        public function __construct(string $token = null, int $length = 48)
        {
            $this->token = $token;

            if ($this->token === null) {
                $this->token = bin2hex(openssl_random_pseudo_bytes($length / 2));
            }
        }

        public function __toString(): string
        {
            return $this->token;
        }
    }
}
