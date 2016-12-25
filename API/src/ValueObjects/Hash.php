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
    class Hash
    {
        /**
         * @var string
         */
        private $hash;

        public function __construct(Password $password)
        {
            $this->hash = password_hash((string) $password, PASSWORD_DEFAULT);
        }

        public function __toString(): string
        {
            return $this->hash;
        }
    }
}
