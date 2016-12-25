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
    class PostTitle
    {
        /**
         * @var string
         */
        private $value;

        public function __construct(string $value)
        {
            $trimmed = trim($value);

            if (empty($value)) {
                throw new \Exception('post title must not be empty');
            }

            if (strlen($trimmed) > 64) {
                throw new \Exception('post title limit of 64 b exceeded');
            }

            $this->value = $trimmed;
        }

        public function __toString(): string
        {
            return $this->value;
        }
    }
}
