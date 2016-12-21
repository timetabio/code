<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Routers
{
    use Timetabio\Framework\Controllers\ControllerInterface;
    use Timetabio\Framework\Exceptions\RouterException;
    use Timetabio\Framework\Http\Request\RequestInterface;

    class Router implements RouterInterface
    {
        /**
         * @var RouterInterface[]
         */
        private $routers = [];

        public function addRouter(RouterInterface $router)
        {
            $this->routers[] = $router;
        }

        public function route(RequestInterface $request): ControllerInterface
        {
            foreach ($this->routers as $router) {
                if (!$router->canHandle($request)) {
                    continue;
                }

                try {
                    return $router->route($request);
                } catch (RouterException $e) {
                    continue;
                }
            }

            throw new RouterException('no route found for "' . $request->getUri()->getPath() . '"');
        }

        public function canHandle(RequestInterface $request): bool
        {
            return true;
        }
    }
}
