<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class ErrorHandlerFactory extends AbstractChildFactory
    {
        public function createDevelopmentErrorHandler(): \Timetabio\API\ErrorHandlers\DevelopmentErrorHandler
        {
            return new \Timetabio\API\ErrorHandlers\DevelopmentErrorHandler;
        }

        public function createProductionErrorHandler(): \Timetabio\API\ErrorHandlers\ProductionErrorHandler
        {
            return new \Timetabio\API\ErrorHandlers\ProductionErrorHandler;
        }
    }
}
