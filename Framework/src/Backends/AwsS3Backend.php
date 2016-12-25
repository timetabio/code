<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\Backends
{
    use Timetabio\S3Helper\Builders\UploadBuilder;
    use Timetabio\S3Helper\Builders\UriBuilder;
    use Timetabio\S3Helper\ValueObjects\FileUpload;

    class AwsS3Backend
    {
        /**
         * @var UploadBuilder
         */
        private $uploadBuilder;

        /**
         * @var UriBuilder
         */
        private $uriBuilder;

        /**
         * @var int
         */
        private $maxFileSize;

        public function __construct(UploadBuilder $uploadBuilder, UriBuilder $uriBuilder, int $maxFileSize)
        {
            $this->uploadBuilder = $uploadBuilder;
            $this->uriBuilder = $uriBuilder;
            $this->maxFileSize = $maxFileSize;
        }

        public function getEndpoint(): string
        {
            return $this->uriBuilder->buildBucketUrl();
        }

        public function createUploadParams(FileUpload $file): array
        {
            return $this->uploadBuilder->buildUploadParams($file, $this->maxFileSize, 5 * 60);
        }
    }
}
