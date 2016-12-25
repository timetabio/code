<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Routers
{
    use Timetabio\Framework\Controllers\ControllerInterface;
    use Timetabio\Framework\Exceptions\RouterException;
    use Timetabio\Framework\Factories\MasterFactoryInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Routers\RouterInterface;
    use Timetabio\Frontend\Queries\IsLoggedInQuery;

    class UserFragmentRouter implements RouterInterface
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
                case '/fragment/homepage-posts':
                    return $this->factory->createGetHomepagePostsFragmentController();
            }

            throw new RouterException;
        }

        public function canHandle(RequestInterface $request): bool
        {
            return $request instanceof \Timetabio\Framework\Http\Request\GetRequest;
        }
    }
}
