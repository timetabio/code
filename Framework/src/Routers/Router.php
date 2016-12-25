<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
