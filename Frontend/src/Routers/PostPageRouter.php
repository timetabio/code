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
    use Timetabio\Frontend\Queries\Post\FetchPostQuery;

    class PostPageRouter implements RouterInterface
    {
        /**
         * @var MasterFactoryInterface
         */
        private $factory;

        /**
         * @var FetchPostQuery
         */
        private $fetchPostQuery;

        public function __construct(MasterFactoryInterface $factory, FetchPostQuery $fetchPostQuery)
        {
            $this->factory = $factory;
            $this->fetchPostQuery = $fetchPostQuery;
        }

        public function route(RequestInterface $request): ControllerInterface
        {
            $parts = $request->getUri()->getExplodedPath();
            $count = count($parts);

            if ($count !== 2 || $parts[0] !== 'post') {
                throw new RouterException;
            }

            $post = $this->fetchPostQuery->execute($parts[1]);

            if ($post === null) {
               throw new RouterException;
            }

            return $this->factory->createGetPostPageController($post);
        }

        public function canHandle(RequestInterface $request): bool
        {
            return $request instanceof \Timetabio\Framework\Http\Request\GetRequest;
        }
    }
}
