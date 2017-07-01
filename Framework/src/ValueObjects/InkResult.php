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
    class InkResult
    {
        /**
         * @var string
         */
        private $body;

        /**
         * @var string
         */
        private $plainText;

        public function __construct(string $body = '', string $plainText = '')
        {
            $this->body = $body;
            $this->plainText = $plainText;
        }

        public function getBody(): string
        {
            return $this->body;
        }

        public function getPlainText(): string
        {
            return $this->plainText;
        }
    }
}
