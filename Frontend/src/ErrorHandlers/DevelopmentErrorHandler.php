<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\ErrorHandlers
{
    use Timetabio\Framework\ErrorHandlers\AbstractErrorHandler;
    use Timetabio\Frontend\Exceptions\AbstractException;

    class DevelopmentErrorHandler extends AbstractErrorHandler
    {
        public function handleException(\Throwable $exception)
        {
            if ($exception instanceof AbstractException) {
                $this->handleAbstractException($exception);
                return;
            }

            $this->handleFatalException($exception);
        }

        private function handleAbstractException(AbstractException $exception)
        {
            http_response_code($exception->getStatusCode()->getCode());

            header('content-type: application/json');

            echo json_encode([
                'error' => $exception->getMessage()
            ]);
        }

        private function handleFatalException(\Throwable $exception)
        {
            http_response_code(500);

            echo '<div class="page-wrapper -padding">';
            echo '<h1 class="basic-heading-a _margin-after">' . htmlentities($exception->getMessage()) . '</h1>';
            echo '<b>File: </b>' . htmlentities($exception->getFile()) . '<br />';
            echo '<b>Line: </b>' . $exception->getLine();

            echo '<pre class="basic-pre _margin-before">' . htmlentities($exception->getTraceAsString()) . '</pre>';
            echo '</div>';

            echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata|Open+Sans:400,400i,700">';
            echo '<link rel="stylesheet" href="/css/application.css" />';

            die();
        }
    }
}
