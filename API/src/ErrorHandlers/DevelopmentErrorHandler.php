<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\ErrorHandlers
{
    use Timetabio\API\Exceptions\AbstractException;
    use Timetabio\Framework\ErrorHandlers\AbstractErrorHandler;
    use Timetabio\Framework\Logging\LoggerAwareInterface;
    use Timetabio\Framework\Logging\LoggerAwareTrait;

    class DevelopmentErrorHandler extends AbstractErrorHandler implements LoggerAwareInterface
    {
        use LoggerAwareTrait;

        public function handleException(\Throwable $exception)
        {
            http_response_code($this->getStatusCode($exception));
            header('content-type: application/json');

            echo json_encode([
                'error' => $this->getError($exception),
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTrace()
            ], JSON_PRETTY_PRINT) . PHP_EOL;

            if (!($exception instanceof AbstractException)) {
                $this->logger->error($exception);
            }

            die();
        }

        public function getStatusCode(\Throwable $exception): int
        {
            if ($exception instanceof AbstractException) {
                return $exception->getStatusCode()->getCode();
            }

            return 500;
        }

        private function getError(\Throwable $exception): string
        {
            if ($exception instanceof AbstractException) {
                return $exception->getId();
            }

            return 'internal_error';
        }
    }
}
