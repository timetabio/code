<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\Http\Headers
{
    class Authorization
    {
        /**
         * @var string
         */
        private $type;

        /**
         * @var string
         */
        private $token;

        public function __construct(string $value)
        {
            $explodedValue = explode(' ', $value);

            if (count($explodedValue) !== 2) {
                throw new \Exception('authorization header must have exactly two parts');
            }

            $this->type = $explodedValue[0];
            $this->token = $explodedValue[1];
        }

        public function getType(): string
        {
            return $this->type;
        }

        public function isBearer(): bool
        {
            return $this->type === 'Bearer';
        }

        public function getToken(): string
        {
            return $this->token;
        }

        public function getBearerToken()
        {
            if (!$this->isBearer()) {
                return null;
            }

            return $this->getToken();
        }
    }
}
