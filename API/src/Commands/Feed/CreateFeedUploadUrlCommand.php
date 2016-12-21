<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
