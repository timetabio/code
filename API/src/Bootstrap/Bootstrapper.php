<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Bootstrap
{
    use Timetabio\Framework\Bootstrap\AbstractBootstrapper;
    use Timetabio\Framework\Configuration\Configuration;
    use Timetabio\Framework\Configuration\ConfigurationInterface;
    use Timetabio\Framework\ErrorHandlers\AbstractErrorHandler;
    use Timetabio\Framework\Factories\MasterFactory;
    use Timetabio\Framework\Factories\MasterFactoryInterface;
    use Timetabio\Framework\Routers\Router;
    use Timetabio\Framework\Routers\RouterInterface;

    class Bootstrapper extends AbstractBootstrapper
    {
        protected function doBootstrap()
        {

        }

        protected function buildConfiguration(): ConfigurationInterface
        {
            return new Configuration(__DIR__ . '/../../config/system.ini');
        }

        protected function buildFactory(): MasterFactoryInterface
        {
            $factory = new MasterFactory($this->getConfiguration());

            $factory->registerFactory(new \Timetabio\Framework\Factories\FrameworkFactory);
            $factory->registerFactory(new \Timetabio\Framework\Factories\BackendFactory);
            $factory->registerFactory(new \Timetabio\Framework\Factories\LoggerFactory);

            $factory->registerFactory(new \Timetabio\Library\Factories\LocatorFactory);
            $factory->registerFactory(new \Timetabio\Library\Factories\ServiceFactory);
            $factory->registerFactory(new \Timetabio\Library\Factories\MapperFactory);

            $factory->registerFactory(new \Timetabio\API\Factories\ControllerFactory);
            $factory->registerFactory(new \Timetabio\API\Factories\ErrorHandlerFactory);
            $factory->registerFactory(new \Timetabio\API\Factories\HandlerFactory);
            $factory->registerFactory(new \Timetabio\API\Factories\QueryFactory);
            $factory->registerFactory(new \Timetabio\API\Factories\RouterFactory);
            $factory->registerFactory(new \Timetabio\API\Factories\EndpointFactory);
            $factory->registerFactory(new \Timetabio\API\Factories\ApplicationFactory);
            $factory->registerFactory(new \Timetabio\API\Factories\CommandFactory);
            $factory->registerFactory(new \Timetabio\API\Factories\MapperFactory);
            $factory->registerFactory(new \Timetabio\API\Factories\ServiceFactory);
            $factory->registerFactory(new \Timetabio\API\Factories\BackendFactory);

            return $factory;
        }

        protected function buildRouter(): RouterInterface
        {
            $router = new Router;

            $router->addRouter($this->getFactory()->createEndpointRouter());

            return $router;
        }

        protected function buildErrorHandler(): AbstractErrorHandler
        {
            if ($this->getConfiguration()->isDevelopmentMode()) {
                return $this->getFactory()->createDevelopmentErrorHandler();
            }

            return $this->getFactory()->createProductionErrorHandler();
        }
    }
}
