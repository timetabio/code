<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
