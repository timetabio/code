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
    interface WriteRequestInterface extends RequestInterface
    {
        /**
         * @param string $name
         * @return bool
         */
        public function hasParam(string $name): bool;

        /**
         * @param string $name
         * @return string
         * @throws \Exception
         */
        public function getParam(string $name);
    }
}
