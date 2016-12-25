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
    class Cookie
    {
        /**
         * @var string
         */
        private $name;

        /**
         * @var string
         */
        private $value;

        /**
         * @var string
         */
        private $path;

        /**
         * @var int
         */
        private $expires;

        /**
         * @var string
         */
        private $domain;

        /**
         * @var bool
         */
        private $secure;

        /**
         * @var bool
         */
        private $httpOnly;

        /**
         * @param string $name
         * @param string $value
         * @param string $path
         * @param int $expires
         * @param string $domain
         * @param bool $secure
         * @param bool $httpOnly
         */
        public function __construct(
            string $name,
            string $value,
            string $path = '/',
            int $expires,
            string $domain = '.timetab.io',
            bool $secure = true,
            bool $httpOnly = true
        )
        {
            $this->name = $name;
            $this->value = $value;
            $this->path = $path;
            $this->expires = $expires;
            $this->domain = $domain;
            $this->secure = $secure;
            $this->httpOnly = $httpOnly;
        }

        public function getName(): string
        {
            return $this->name;
        }

        public function getValue(): string
        {
            return $this->value;
        }

        public function getPath(): string
        {
            return $this->path;
        }

        public function getExpires(): int
        {
            return $this->expires;
        }

        public function getDomain(): string
        {
            return $this->domain;
        }

        public function isSecure(): bool
        {
            return $this->secure;
        }

        public function isHttpOnly(): bool
        {
            return $this->httpOnly;
        }
    }
}
