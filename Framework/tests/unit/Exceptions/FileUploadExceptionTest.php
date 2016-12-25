<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\Exceptions
{
    /**
     * @covers \Timetabio\Framework\Exceptions\FileUploadException
     */
    class FileUploadExceptionTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @dataProvider provideErrorCodes
         */
        public function testConstructorWorks(int $code, string $message)
        {
            $exception = new FileUploadException($code);

            $this->assertEquals($code, $exception->getCode());
            $this->assertEquals($message, $exception->getMessage());
        }

        public function provideErrorCodes(): array
        {
            return [
                [UPLOAD_ERR_INI_SIZE, 'The uploaded file exceeds the upload_max_filesize directive in php.ini.'],
                [UPLOAD_ERR_FORM_SIZE, 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.'],
                [UPLOAD_ERR_PARTIAL, 'The uploaded file was only partially uploaded.'],
                [UPLOAD_ERR_NO_FILE, 'No file was uploaded.'],
                [UPLOAD_ERR_NO_TMP_DIR, 'Missing a temporary folder.'],
                [UPLOAD_ERR_CANT_WRITE, 'Failed to write file to disk.'],
                [UPLOAD_ERR_EXTENSION, 'A PHP extension stopped the file upload.'],
                [-1, 'An unknown error occurred'],
                [99, 'An unknown error occurred']
            ];
        }
    }
}
