<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Factories
{
    class FrameworkFactory extends AbstractChildFactory
    {
        /**
         * @var \Timetabio\Framework\DataStore\RedisBackend
         */
        private $redisBackend;

        public function createCurl(): \Timetabio\Framework\Curl\Curl
        {
            return new \Timetabio\Framework\Curl\Curl(
                $this->getMasterFactory()->createCurlHandler()
            );
        }

        public function createCurlHandler(): \Timetabio\Framework\Curl\CurlHandler
        {
            return new \Timetabio\Framework\Curl\CurlHandler;
        }

        public function createRedisBackend(): \Timetabio\Framework\DataStore\RedisBackend
        {
            if ($this->redisBackend === null) {
                $this->redisBackend = new \Timetabio\Framework\DataStore\RedisBackend(
                    new \Redis,
                    $this->getMasterFactory()->getConfiguration()->getRedisHost(),
                    $this->getMasterFactory()->getConfiguration()->getRedisPort()
                );
            }

            return $this->redisBackend;
        }

        public function createGettext(): \Timetabio\Framework\Translation\Gettext
        {
            return new \Timetabio\Framework\Translation\Gettext;
        }

        public function createS3HelperUploadBuilder(): \Timetabio\S3Helper\Builders\UploadBuilder
        {
            return new \Timetabio\S3Helper\Builders\UploadBuilder(
                $this->createS3HelperConfiguration()
            );
        }

        public function createS3HelperRequestBuilder(): \Timetabio\S3Helper\Builders\RequestBuilder
        {
            return new \Timetabio\S3Helper\Builders\RequestBuilder(
                $this->createS3HelperConfiguration(),
                $this->getMasterFactory()->createS3HelperUriBuilder()
            );
        }

        public function createS3HelperUriBuilder(): \Timetabio\S3Helper\Builders\UriBuilder
        {
            return new \Timetabio\S3Helper\Builders\UriBuilder(
                $this->getMasterFactory()->getConfiguration()->get('s3Bucket')
            );
        }

        private function createS3HelperConfiguration(): \Timetabio\S3Helper\ValueObjects\Configuration
        {
            $config = $this->getMasterFactory()->getConfiguration();

            return new \Timetabio\S3Helper\ValueObjects\Configuration(
                $config->get('s3AccessKey'),
                $config->get('s3AccessSecret'),
                $config->get('s3Region'),
                $config->get('s3Bucket')
            );
        }
    }
}
