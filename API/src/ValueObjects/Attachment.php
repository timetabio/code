<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\ValueObjects
{
    class Attachment
    {
        /**
         * @var string
         */
        private $publicId;

        /**
         * @var string
         */
        private $fileId;

        public function __construct(string $filename)
        {
            $this->publicId = $filename;
        }

        public function getPublicId(): string
        {
            return $this->publicId;
        }

        public function getFileId(): string
        {
            return $this->fileId;
        }

        public function setFileId(string $fileId)
        {
            $this->fileId = $fileId;
        }
    }
}
