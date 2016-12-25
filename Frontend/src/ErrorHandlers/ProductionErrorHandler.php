<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\ErrorHandlers
{
    use Timetabio\Framework\ErrorHandlers\AbstractErrorHandler;
    use Timetabio\Framework\Logging\LoggerAwareInterface;
    use Timetabio\Framework\Logging\LoggerAwareTrait;
    use Timetabio\Frontend\Exceptions\AbstractException;

    class ProductionErrorHandler extends AbstractErrorHandler implements LoggerAwareInterface
    {
        use LoggerAwareTrait;

        public function handleException(\Throwable $exception)
        {
            if ($exception instanceof AbstractException) {
                $this->handleAbstractException($exception);
                return;
            }

            $this->getLogger()->error($exception);

            header('Location: /error');
            exit;
        }

        private function handleAbstractException(AbstractException $exception)
        {
            http_response_code($exception->getStatusCode()->getCode());

            header('content-type: application/json');

            echo json_encode([
                'error' => $exception->getMessage()
            ]);
        }
    }
}
