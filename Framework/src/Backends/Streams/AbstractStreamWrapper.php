<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\Backends\Streams
{
    abstract class AbstractStreamWrapper
    {
        /**
         * @var resource
         */
        private $resource;

        public static function setUp(string $basePath)
        {
            static::setBasePath($basePath);

            stream_register_wrapper(static::getProtocol(), static::class);
        }

        public function url_stat(string $path)
        {
            $path = $this->transformPath($path);

            return stat($path);
        }

        public function stream_stat(): array
        {
            return fstat($this->resource);
        }

        public function stream_open(string $path, string $mode = null): bool
        {
            $path = $this->transformPath($path);

            $this->resource = fopen($path, $mode);

            return (bool) $this->resource;
        }

        public function stream_read(int $count)
        {
            return fread($this->resource, $count);
        }

        public function stream_eof(): bool
        {
            return feof($this->resource);
        }

        protected function transformPath(string $path): string
        {
            $uri = parse_url($path);
            $filePath = static::getBasePath();

            if (isset($uri['host'])) {
                $filePath .= '/' . $uri['host'];
            }

            if (isset($uri['path'])) {
                $filePath .= $uri['path'];
            }

            return $filePath;
        }

        abstract protected static function getBasePath(): string;

        abstract protected static function setBasePath(string $basePath);

        abstract protected static function getProtocol(): string;
    }
}
