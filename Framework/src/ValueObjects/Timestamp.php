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
    class Timestamp
    {
        /**
         * @var int
         */
        private $timestamp;

        public function __construct(int $timestamp)
        {
            $this->timestamp = $timestamp;
        }

        public function getTimestamp(): int
        {
            return $this->timestamp;
        }

        public function __toString(): string
        {
            return gmdate('Y-m-d H:i:s.u', $this->timestamp);
        }
    }
}
