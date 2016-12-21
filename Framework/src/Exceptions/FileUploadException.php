<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Exceptions
{
    class FileUploadException extends \RuntimeException
    {
        /**
         * @param int $code
         */
        public function __construct($code)
        {
            parent::__construct($this->getMessageForCode($code), $code);
        }

        /**
         * @param int $code
         * @return string
         * @link http://php.net/manual/en/features.file-upload.errors.php
         */
        private function getMessageForCode(int $code): string
        {
            switch ($code) {
                case UPLOAD_ERR_INI_SIZE:
                    return 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
                case UPLOAD_ERR_FORM_SIZE:
                    return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
                case UPLOAD_ERR_PARTIAL:
                    return 'The uploaded file was only partially uploaded.';
                case UPLOAD_ERR_NO_FILE:
                    return 'No file was uploaded.';
                case UPLOAD_ERR_NO_TMP_DIR:
                    return 'Missing a temporary folder.';
                case UPLOAD_ERR_CANT_WRITE:
                    return 'Failed to write file to disk.';
                case UPLOAD_ERR_EXTENSION:
                    return 'A PHP extension stopped the file upload.';
            }

            return 'An unknown error occurred';
        }
    }
}
