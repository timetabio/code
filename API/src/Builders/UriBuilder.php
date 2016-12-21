<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
