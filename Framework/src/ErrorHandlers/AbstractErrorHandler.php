<?php
// @codeCoverageIgnoreStart
/**
 * (c) 2016 Ruben Schmidmeister
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
