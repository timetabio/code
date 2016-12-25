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
namespace Timetabio\Framework\ErrorHandlers
{
    abstract class AbstractErrorHandler
    {
        /**
         * @var bool
         */
        private $registered = false;

        public function register()
        {
            set_error_handler([$this, 'handleError'], E_WARNING | E_NOTICE | E_DEPRECATED | E_STRICT);
            set_exception_handler([$this, 'handleException']);

            $this->registered = true;
        }

        public function __destruct()
        {
            if (!$this->registered) {
                return;
            }

            restore_error_handler();
            restore_exception_handler();
        }

        // @codeCoverageIgnoreEnd

        public function handleError(int $errno, string $errstr, string $errfile = '', int $errline = 0)
        {
            throw new \ErrorException($errstr, -1, $errno, $errfile, $errline);
        }

        abstract public function handleException(\Throwable $exception);
    }
}
