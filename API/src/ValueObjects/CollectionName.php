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
    class CollectionName
    {
        /**
         * @var string
         */
        private $name;

        public function __construct(string $name)
        {
            $name = trim($name);
            $length = mb_strlen($name);

            // TODO: 40 characters?
            if ($length <= 1 || $length >= 40) {
                throw new \Exception('collection name must be between 1 and 40 characters long');
            }

            // TODO: Maybe regex check?

            $this->name = $name;
        }

        public function __toString(): string
        {
            return $this->name;
        }
    }
}
