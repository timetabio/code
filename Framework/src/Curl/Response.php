<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\Curl
{
    class Response
    {
        /**
         * @var int
         */
        private $code;

        /**
         * @var string
         */
        private $body;

        public function __construct(int $code, string $body)
        {
            $this->code = $code;
            $this->body = $body;
        }

        public function getCode(): int
        {
            return $this->code;
        }

        public function getBody(): string
        {
            return $this->body;
        }

        public function getJsonDecodedBody()
        {
            return json_decode($this->body, true);
        }
    }
}
