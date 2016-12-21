<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Bootstrap
{
    use Timetabio\Framework\Bootstrap\AbstractBootstrapper;
    use Timetabio\Framework\Configuration\Configuration;
    use Timetabio\Framework\Configuration\ConfigurationInterface;
    use Timetabio\Framework\ErrorHandlers\AbstractErrorHandler;
    use Timetabio\Framework\Factories\MasterFactory;
    use Timetabio\Framework\Factories\MasterFactoryInterface;
    use Timetabio\Framework\Routers\Router;
    use Timetabio\Framework\Routers\RouterInterface;
    use Timetabio\Framework\Translation\Gettext;
    use Timetabio\Frontend\Session\Session;
    use Timetabio\Library\Backends\Streams\PagesStreamWrapper;
    use Timetabio\Library\Backends\Streams\TemplatesStreamWrapper;

    class Bootstrapper extends AbstractBootstrapper
    {
        protected function doBootstrap()
        {
            $this->bootstrapStreamWrappers();
            $this->bootstrapGettext();
            $this->bootstrapSession();
        }

        private function bootstrapSession()
        {
            /** @var Session $session */
            $session = $this->getFactory()->createSession();

            $session->loadRequest($this->getRequest());
        }

        private function bootstrapStreamWrappers()
        {
            TemplatesStreamWrapper::setUp(__DIR__ . '/../../data/templates');
        }

        private function bootstrapGettext()
        {
            $gettext = new Gettext;
            $gettext->setUp('messages', __DIR__ . '/../../../Locale');
            $gettext->setLanguage($this->getRequest()->getLanguage());
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

            $factory->registerFactory(new \Timetabio\Library\Factories\ApplicationFactory);
            $factory->registerFactory(new \Timetabio\Library\Factories\LocatorFactory);

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

            return $factory;
        }

        protected function buildRouter(): RouterInterface
        {
            $router = new Router;

            // NOTE: The PageRouter always needs to be added earlier than the StaticPageRouter,
            // because it overrides the / route from the static page renderer
            $router->addRouter($this->getFactory()->createUserPageRouter());
            $router->addRouter($this->getFactory()->createStaticPageRouter());
            $router->addRouter($this->getFactory()->createPageRouter());
            $router->addRouter($this->getFactory()->createFeedPageRouter());
            $router->addRouter($this->getFactory()->createPostPageRouter());
            $router->addRouter($this->getFactory()->createUserActionRouter());
            $router->addRouter($this->getFactory()->createActionRouter());
            $router->addRouter($this->getFactory()->createUserFragmentRouter());
            $router->addRouter($this->getFactory()->createFragmentRouter());

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
