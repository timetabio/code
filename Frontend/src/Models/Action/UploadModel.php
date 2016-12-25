<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
