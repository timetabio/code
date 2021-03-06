<?php
// @codeCoverageIgnoreStart
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\ValueObjects
{
    use Timetabio\Framework\Exceptions\FileUploadException;

    class UploadedFile
    {
        /**
         * @var array
         */
        private $file;

        /**
         * @param array $file
         * @throws \RuntimeException
         */
        public function __construct(array $file)
        {
            if (!isset($file['error']) || is_array($file['error'])) {
                throw new \RuntimeException('corrupt upload info');
            }

            if (!is_uploaded_file($file['tmp_name'])) {
                throw new \RuntimeException('the file "' . $file['tmp_name'] . ' was not uploaded');
            }

            if ($file['error'] !== UPLOAD_ERR_OK) {
                throw new FileUploadException($file['error']);
            }

            $this->file = $file;
        }

        /**
         * @return string
         */
        public function getName()
        {
            return $this->file['name'];
        }

        /**
         * @return string
         */
        public function getTmpName()
        {
            return $this->file['tmp_name'];
        }

        /**
         * @return string
         */
        public function getMimeType()
        {
            return mime_content_type($this->getTmpName());
        }

        /**
         * @return string
         */
        public function getExtension()
        {
            return pathinfo($this->getName(), PATHINFO_EXTENSION);
        }
    }
}
// @codeCoverageIgnoreEnd
