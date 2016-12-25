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
