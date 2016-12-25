<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
