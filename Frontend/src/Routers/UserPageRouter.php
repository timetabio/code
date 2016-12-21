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
    use Timetabio\Frontend\Queries\IsLoggedInQuery;

    class UserPageRouter implements RouterInterface
    {
        /**
         * @var MasterFactoryInterface
         */
        private $factory;

        /**
         * @var IsLoggedInQuery
         */
        private $isLoggedInQuery;

        public function __construct(MasterFactoryInterface $factory, IsLoggedInQuery $isLoggedInQuery)
        {
            $this->factory = $factory;
            $this->isLoggedInQuery = $isLoggedInQuery;
        }

        public function route(RequestInterface $request): ControllerInterface
        {
            if (!$this->isLoggedInQuery->execute()) {
                throw new RouterException;
            }

            switch ($request->getUri()->getPath()) {
                case '/':
                    return $this->factory->createHomepageController();
                case '/feeds':
                    return $this->factory->createFeedsPageController();
                case '/search':
                    return $this->factory->createSearchPageController(new \Timetabio\Library\SearchTypes\All);
                case '/search/feeds':
                    return $this->factory->createSearchPageController(new \Timetabio\Library\SearchTypes\Feed);
                case '/search/posts':
                    return $this->factory->createSearchPageController(new \Timetabio\Library\SearchTypes\Post);
            }

            throw new RouterException;
        }

        public function canHandle(RequestInterface $request): bool
        {
            return $request instanceof \Timetabio\Framework\Http\Request\GetRequest;
        }
    }
}
