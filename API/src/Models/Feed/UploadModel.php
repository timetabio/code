<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
