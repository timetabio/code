<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Builders
{
    class UriBuilder
    {
        /**
         * @var \Timetabio\S3Helper\Builders\UriBuilder
         */
        private $s3UriBuilder;

        public function __construct(\Timetabio\S3Helper\Builders\UriBuilder $s3UriBuilder)
        {
            $this->s3UriBuilder = $s3UriBuilder;
        }

        public function buildFileUri(string $publicId, string $filename): string
        {
            return $this->s3UriBuilder->buildObjectUrl($publicId . '/' . urlencode($filename));
        }
    }
}
