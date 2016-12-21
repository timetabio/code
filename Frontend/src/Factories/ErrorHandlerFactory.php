<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class ErrorHandlerFactory extends AbstractChildFactory
    {
        public function createDevelopmentErrorHandler(): \Timetabio\Frontend\ErrorHandlers\DevelopmentErrorHandler
        {
            return new \Timetabio\Frontend\ErrorHandlers\DevelopmentErrorHandler;
        }

        public function createProductionErrorHandler(): \Timetabio\Frontend\ErrorHandlers\ProductionErrorHandler
        {
            return new \Timetabio\Frontend\ErrorHandlers\ProductionErrorHandler;
        }
    }
}
