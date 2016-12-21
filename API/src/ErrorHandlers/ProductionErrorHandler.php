<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\ErrorHandlers
{
    use Timetabio\API\Exceptions\AbstractException;
    use Timetabio\Framework\ErrorHandlers\AbstractErrorHandler;
    use Timetabio\Framework\Logging\LoggerAwareInterface;
    use Timetabio\Framework\Logging\LoggerAwareTrait;

    class ProductionErrorHandler extends AbstractErrorHandler implements LoggerAwareInterface
    {
        use LoggerAwareTrait;

        public function handleException(\Throwable $exception)
        {
            http_response_code($this->getStatusCode($exception));
            header('content-type: application/json');

            echo json_encode([
                'error' => $this->getError($exception),
                'message' => $this->getMessage($exception),
            ], JSON_PRETTY_PRINT);

            $this->logException($exception);

            die();
        }

        private function getError(\Throwable $exception): string
        {
            if ($exception instanceof AbstractException) {
                return $exception->getId();
            }

            return 'internal_error';
        }

        private function getMessage(\Throwable $exception): string
        {
            if ($exception instanceof AbstractException) {
                return $exception->getMessage();
            }

            return 'internal server error';
        }

        private function getStatusCode(\Throwable $exception): int
        {
            if ($exception instanceof AbstractException) {
                return $exception->getStatusCode()->getCode();
            }

            return 500;
        }

        private function logException(\Throwable $exception)
        {
            if ($exception instanceof AbstractException) {
                return;
            }

            $this->getLogger()->error($exception);
        }
    }
}
