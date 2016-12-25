<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Library\ValueObjects
{
    class DisplayName
    {
        /**
         * @var string
         */
        private $value;

        public function __construct(array $user)
        {
            $this->value = $this->parse($user);
        }

        private function parse(array $user): string
        {
            if (isset($user['name']) && $user['name'] !== '') {
                return $user['name'];
            }

            return '@' . $user['username'];
        }

        public function __toString(): string
        {
            return $this->value;
        }
    }
}
