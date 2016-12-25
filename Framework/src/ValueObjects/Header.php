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
    class Header
    {
        /**
         * @var string
         */
        private $name;

        /**
         * @var string
         */
        private $value;

        public function __construct(string $name, string $value)
        {
            $this->name = strtolower($name);
            $this->value = $value;
        }

        public function getName(): string
        {
            return $this->name;
        }

        public function getValue(): string
        {
            return $this->value;
        }

        public function __toString()
        {
            return $this->name . ': ' . $this->value;
        }
    }
}
