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
    use MongoDB\BSON\UTCDateTime;

    class BsonDateTime
    {
        /**
         * @var UTCDateTime
         */
        private $value;

        public function __construct(int $time = null)
        {
            if ($time === null) {
                $time = time();
            }

            $this->value = new UTCDateTime($time * 1000);
        }

        public function getValue(): UTCDateTime
        {
            return $this->value;
        }
    }
}
