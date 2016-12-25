<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\Curl\Credentials
{
    class BasicAuth extends AbstractCredentials
    {
        /**
         * @var string
         */
        private $username;

        /**
         * @var string
         */
        private $password;

        public function __construct(string $username, string $password)
        {
            $this->username = $username;
            $this->password = $password;
        }

        public function getType(): string
        {
            return 'Basic';
        }

        public function getValue(): string
        {
            return base64_encode($this->username . ':' . $this->password);
        }
    }
}
