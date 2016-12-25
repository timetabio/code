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
    class PostBody
    {
        /**
         * @var string
         */
        private $value;

        public function __construct(string $value)
        {
            // 8 KiB = 8192 B
            if (strlen($value) > 8192) {
                throw new \Exception('post max size exceeded');
            }

            $this->value = $value;
        }

        public function __toString(): string
        {
            return $this->value;
        }
    }
}
