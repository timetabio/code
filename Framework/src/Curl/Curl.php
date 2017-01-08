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
    use Timetabio\Framework\Curl\Credentials\CredentialsInterface;
    use Timetabio\Framework\Curl\RequestMethods\{
        Delete, Get, Head, Patch, Post, Put
    };
    use Timetabio\Framework\ValueObjects\Uri;

    class Curl
    {
        /**
         * @var CurlHandler
         */
        private $handler;

        public function __construct(CurlHandler $handler)
        {
            $this->handler = $handler;
        }

        public function post(Uri $url, array $params = [], CredentialsInterface $credentials = null): Response
        {
            return $this->handler->executeRequest($url, new Post, $params, $credentials);
        }

        public function put(Uri $url, array $params = [], CredentialsInterface $credentials = null): Response
        {
            return $this->handler->executeRequest($url, new Put, $params, $credentials);
        }

        public function patch(Uri $url, array $params = [], CredentialsInterface $credentials = null): Response
        {
            return $this->handler->executeRequest($url, new Patch, $params, $credentials);
        }

        public function get(Uri $url, CredentialsInterface $credentials = null): Response
        {
            return $this->handler->executeRequest($url, new Get, [], $credentials);
        }

        public function delete(Uri $url, CredentialsInterface $credentials = null, array $headers = []): Response
        {
            return $this->handler->executeRequest($url, new Delete, [], $credentials, $headers);
        }

        public function head(Uri $url, CredentialsInterface $credentials = null): Response
        {
            return $this->handler->executeRequest($url, new Head, [], $credentials);
        }
    }
}
