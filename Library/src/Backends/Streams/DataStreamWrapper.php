<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Library\Backends\Streams
{
    use Timetabio\Framework\Backends\Streams\AbstractStreamWrapper;

    class DataStreamWrapper extends AbstractStreamWrapper
    {
        /**
         * @var string
         */
        private static $basePath;

        protected static function getProtocol(): string
        {
            return 'dataDir';
        }

        protected static function getBasePath(): string
        {
            return self::$basePath;
        }

        protected static function setBasePath(string $basePath)
        {
            self::$basePath = $basePath;
        }
    }
}
