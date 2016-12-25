<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\Logging\Loggers
{
    use Timetabio\Framework\Backends\FileBackend;
    use Timetabio\Framework\Logging\Logs\AbstractLog;

    class NsaLogger implements LoggerInterface
    {
        /**
         * @var FileBackend
         */
        private $fileBackend;

        /**
         * @var string
         */
        private $fileName;

        public function __construct(FileBackend $fileBackend, string $fileName)
        {
            $this->fileBackend = $fileBackend;
            $this->fileName = $fileName;
        }

        public function log(AbstractLog $log)
        {
            $this->fileBackend->append(
                $this->fileName,
                '[' . date('d.m.Y H:i:s') . '] ' . $log . PHP_EOL . PHP_EOL
            );
        }

        public function handles(AbstractLog $log): bool
        {
            return true;
        }
    }
}
