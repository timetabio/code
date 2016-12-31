<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\ValueObjects
{
    class RedirectUri implements \JsonSerializable
    {
        /**
         * @var string
         */
        private $uri;

        public function __construct(string $uri)
        {
            if (!preg_match('/^[\w\-\/]+$/', $uri)) {
                throw new \Exception('invalid redirect uri');
            }

            $this->uri = $uri;
        }

        public function __toString(): string
        {
            return $this->uri;
        }

        public function jsonSerialize(): string
        {
            return $this->uri;
        }
    }
}
