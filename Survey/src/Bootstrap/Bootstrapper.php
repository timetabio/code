<?php
namespace Timetabio\Survey\Bootstrap
{
    use Timetabio\Framework\Bootstrap\AbstractBootstrapper;
    use Timetabio\Framework\Configuration\Configuration;
    use Timetabio\Framework\Configuration\ConfigurationInterface;
    use Timetabio\Framework\ErrorHandlers\AbstractErrorHandler;
    use Timetabio\Framework\Factories\MasterFactory;
    use Timetabio\Framework\Factories\MasterFactoryInterface;
    use Timetabio\Framework\Routers\Router;
    use Timetabio\Framework\Routers\RouterInterface;
    use Timetabio\Frontend\Session\Session;
    use Timetabio\Library\Backends\Streams\TemplatesStreamWrapper;

    /**
     * (c) 2016 Ruben Schmidmeister
     */
    class Bootstrapper extends AbstractBootstrapper
    {
        protected function doBootstrap()
        {
            $this->bootstrapStreamWrappers();
            $this->bootstrapSession();
        }

        private function bootstrapStreamWrappers()
        {
            TemplatesStreamWrapper::setUp(__DIR__ . '/../../data/templates');
        }

        private function bootstrapSession()
        {
            /** @var Session $session */
            $session = $this->getFactory()->createSession();

            $session->loadRequest($this->getRequest());
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

            $factory->registerFactory(new \Timetabio\Frontend\Factories\ApplicationFactory);
            $factory->registerFactory(new \Timetabio\Frontend\Factories\ErrorHandlerFactory);
            $factory->registerFactory(new \Timetabio\Frontend\Factories\ControllerFactory);
            $factory->registerFactory(new \Timetabio\Frontend\Factories\HandlerFactory);
            $factory->registerFactory(new \Timetabio\Frontend\Factories\RendererFactory);
            $factory->registerFactory(new \Timetabio\Frontend\Factories\TransformationFactory);
            $factory->registerFactory(new \Timetabio\Frontend\Factories\RouterFactory);
            $factory->registerFactory(new \Timetabio\Frontend\Factories\QueryFactory);
            $factory->registerFactory(new \Timetabio\Frontend\Factories\LocatorFactory);
            $factory->registerFactory(new \Timetabio\Frontend\Factories\SessionFactory);
            $factory->registerFactory(new \Timetabio\Frontend\Factories\CommandFactory);

            $factory->registerFactory(new \Timetabio\Survey\Factories\QueryFactory);
            $factory->registerFactory(new \Timetabio\Survey\Factories\RouterFactory);
            $factory->registerFactory(new \Timetabio\Survey\Factories\HandlerFactory);
            $factory->registerFactory(new \Timetabio\Survey\Factories\ControllerFactory);
            $factory->registerFactory(new \Timetabio\Survey\Factories\RendererFactory);
            $factory->registerFactory(new \Timetabio\Survey\Factories\CommandFactory);
            $factory->registerFactory(new \Timetabio\Survey\Factories\ApplicationFactory);

            return $factory;
        }

        protected function buildRouter(): RouterInterface
        {
            $router = new Router;

            $router->addRouter($this->getFactory()->createBetaSurveyRouter());
            $router->addRouter($this->getFactory()->createSurveyActionRouter());
            $router->addRouter($this->getFactory()->createPostSurveyRouter());
            $router->addRouter($this->getFactory()->createNotFoundRouter());

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
