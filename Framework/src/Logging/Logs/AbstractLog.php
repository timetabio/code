<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\Logging\Logs
{
    abstract class AbstractLog
    {
        /**
         * @var \Throwable
         */
        private $exception;

        public function __construct(\Throwable $exception)
        {
            $this->exception = $exception;
        }

        public function getMessage(): string
        {
            return $this->exception->getMessage();
        }

        public function getStringTrace(): string
        {
            return $this->exception->getTraceAsString();
        }

        public function getFile(): string
        {
            return $this->exception->getFile();
        }

        public function getLine(): int
        {
            return $this->exception->getLine();
        }

        public function __toString(): string
        {
            return get_class($this->exception) . ': "' . $this->getMessage() . '"' .
                ' in file ' . $this->getFile() . ' on line ' . $this->getLine() .
                PHP_EOL . $this->getStringTrace();
        }
    }
}
