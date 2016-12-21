<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\ValueObjects
{

    class FeedFile
    {
        /**
         * @var string
         */
        private $filename;

        /**
         * @var FileToken
         */
        private $publicId;

        public function __construct(string $filename)
        {
            $this->filename = $this->parse($filename);
            $this->publicId = new FileToken;
        }

        private function parse(string $filename): string
        {
            $info = pathinfo($filename);

            return $info['basename'];
        }

        public function getPublicId(): FileToken
        {
            return $this->publicId;
        }

        public function getFilename(): string
        {
            return $this->filename;
        }

        public function __toString(): string
        {
            return $this->publicId . '/' . $this->filename;
        }
    }
}
