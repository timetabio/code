<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Survey\ValueObjects
{
    class AnswerValue
    {
        /**
         * @var int
         */
        private $value;

        public function __construct(int $value)
        {
            if ($value > 2 || $value < -2) {
                throw new \Exception('invalid answer value');
            }

            $this->value = $value;
        }

        public function getValue(): int
        {
            return $this->value;
        }
    }
}
