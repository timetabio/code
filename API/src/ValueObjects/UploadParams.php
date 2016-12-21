<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\ValueObjects
{
    class UploadParams
    {
        /**
         * @var FeedFile
         */
        private $file;

        /**
         * @var string
         */
        private $endpoint;

        /**
         * @var array
         */
        private $params;

        public function __construct(FeedFile $file, string $endpoint, array $params)
        {
            $this->file = $file;
            $this->endpoint = $endpoint;
            $this->params = $params;
        }

        public function getFile(): FeedFile
        {
            return $this->file;
        }

        public function getEndpoint(): string
        {
            return $this->endpoint;
        }

        public function getParams(): array
        {
            return $this->params;
        }
    }
}
