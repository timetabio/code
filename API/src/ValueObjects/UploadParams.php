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
