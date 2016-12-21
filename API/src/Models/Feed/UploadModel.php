<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Models\Feed
{
    use Timetabio\API\Models\APIModel;

    class UploadModel extends APIModel
    {
        /**
         * @var string
         */
        private $mimeType;

        /**
         * @var string
         */
        private $filename;

        /**
         * @var string
         */
        private $feedId;

        public function getMimeType(): string
        {
            return $this->mimeType;
        }

        public function setMimeType(string $mimeType)
        {
            $this->mimeType = $mimeType;
        }

        public function getFilename(): string
        {
            return $this->filename;
        }

        public function setFilename(string $filename)
        {
            $this->filename = $filename;
        }

        public function getFeedId(): string
        {
            return $this->feedId;
        }

        public function setFeedId(string $feedId)
        {
            $this->feedId = $feedId;
        }
    }
}
