<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Models\Action
{
    use Timetabio\Frontend\Models\ActionModel;

    class UploadModel extends ActionModel
    {
        /**
         * @var string
         */
        private $filename;

        /**
         * @var string
         */
        private $mimeType;

        public function getFilename(): string
        {
            return $this->filename;
        }

        public function setFilename(string $filename)
        {
            $this->filename = $filename;
        }

        public function getMimeType(): string
        {
            return $this->mimeType;
        }

        public function setMimeType(string $mimeType)
        {
            $this->mimeType = $mimeType;
        }
    }
}
