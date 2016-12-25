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
    class StringBoolean
    {
        /**
         * @var bool
         */
        private $value;

        public function __construct(string $value)
        {
            $this->value = $this->parseValue($value);
        }

        private function parseValue(string $value): bool
        {
            switch ($value) {
                case 'true':
                    return true;
                case 'false':
                    return false;
            }

            throw new \Exception('invalid value');
        }

        public function getValue(): bool
        {
            return $this->value;
        }
    }
}
