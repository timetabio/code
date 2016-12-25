<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\Http\Request
{
    use Timetabio\Framework\ValueObjects\UploadedFile;
    use Timetabio\Framework\ValueObjects\Uri;

    class PostRequest extends AbstractWriteRequest
    {
        /**
         * @var array
         */
        private $files;

        public function __construct(Uri $uri, array $server, array $cookies, array $body, array $files)
        {
            parent::__construct($uri, $server, $cookies, $body);

            $this->files = $files;
        }

        public function hasFile(string $name): bool
        {
            return isset($this->files[$name]);
        }

        // @codeCoverageIgnoreStart
        public function getFile(string $name): UploadedFile
        {
            if (!isset($this->files[$name])) {
                throw new \Exception('file with name "' . $name . '" was not found in request');
            }

            return new UploadedFile($this->files[$name]);
        }
        // @codeCoverageIgnoreEnd
    }
}
