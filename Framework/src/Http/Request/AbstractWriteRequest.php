<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\Http\Request
{
    use Timetabio\Framework\ValueObjects\Uri;

    abstract class AbstractWriteRequest extends AbstractRequest implements WriteRequestInterface
    {
        /**
         * @var array
         */
        private $body;

        public function __construct(Uri $uri, array $server, array $cookies, array $body)
        {
            parent::__construct($uri, $server, $cookies);

            $this->body = $body;
        }

        public function hasParam(string $name): bool
        {
            return isset($this->body[$name]);
        }

        public function getParam(string $name)
        {
            if (!isset($this->body[$name])) {
                throw new \Exception('param with name "' . $name . '" was not found in request');
            }

            return $this->body[$name];
        }
    }
}
