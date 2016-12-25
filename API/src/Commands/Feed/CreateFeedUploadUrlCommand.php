<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Commands\Feed
{
    use Timetabio\API\ValueObjects\FeedFile;
    use Timetabio\API\ValueObjects\UploadParams;
    use Timetabio\Framework\Backends\AwsS3Backend;
    use Timetabio\S3Helper\ValueObjects\FileUpload;

    class CreateFeedUploadUrlCommand
    {
        /**
         * @var AwsS3Backend
         */
        private $awsS3Backend;

        public function __construct(AwsS3Backend $awsS3Backend)
        {
            $this->awsS3Backend = $awsS3Backend;
        }

        public function execute(string $filename, string $mimeType): UploadParams
        {
            $filename = new FeedFile($filename);
            $file = new FileUpload($filename, $mimeType);

            return new UploadParams(
                $filename,
                $this->awsS3Backend->getEndpoint(),
                $this->awsS3Backend->createUploadParams($file)
            );
        }
    }
}
