<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Routers
{
    use Timetabio\Framework\Controllers\ControllerInterface;
    use Timetabio\Framework\Exceptions\RouterException;
    use Timetabio\Framework\Factories\MasterFactoryInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Routers\RouterInterface;
    use Timetabio\Frontend\DataStore\DataStoreReader;

    class StaticPageRouter implements RouterInterface
    {
        /**
         * @var MasterFactoryInterface
         */
        private $factory;

        /**
         * @var DataStoreReader
         */
        private $dataStoreReader;

        public function __construct(MasterFactoryInterface $factory, DataStoreReader $dataStoreReader)
        {
            $this->factory = $factory;
            $this->dataStoreReader = $dataStoreReader;
        }

        public function route(RequestInterface $request): ControllerInterface
        {
            $path = $request->getUri()->getPath();

            if (!$this->dataStoreReader->hasRoute($path)) {
                throw new RouterException;
            }

            $name = $this->dataStoreReader->getRoute($path);

            return $this->factory->createStaticPageController($name, $request->getLanguage());
        }

        public function canHandle(RequestInterface $request): bool
        {
            return $request instanceof \Timetabio\Framework\Http\Request\GetRequest;
        }
    }
}
