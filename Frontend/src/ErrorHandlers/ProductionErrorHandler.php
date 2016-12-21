<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
