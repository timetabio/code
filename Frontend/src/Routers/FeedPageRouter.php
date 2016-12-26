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
    use Timetabio\Frontend\Queries\Feed\LookupVanityQuery;
    use Timetabio\Frontend\Queries\FetchFeedQuery;
    use Timetabio\Frontend\Queries\IsLoggedInQuery;

    class FeedPageRouter implements RouterInterface
    {
        /**
         * @var MasterFactoryInterface
         */
        private $factory;

        /**
         * @var FetchFeedQuery
         */
        private $fetchFeedQuery;

        /**
         * @var LookupVanityQuery
         */
        private $lookupVanityQuery;

        /**
         * @var IsLoggedInQuery
         */
        private $isLoggedInQuery;

        public function __construct(
            MasterFactoryInterface $factory,
            FetchFeedQuery $fetchFeedQuery,
            LookupVanityQuery $lookupVanityQuery,
            IsLoggedInQuery $isLoggedInQuery
        )
        {
            $this->factory = $factory;
            $this->fetchFeedQuery = $fetchFeedQuery;
            $this->lookupVanityQuery = $lookupVanityQuery;
            $this->isLoggedInQuery = $isLoggedInQuery;
        }

        public function route(RequestInterface $request): ControllerInterface
        {
            $parts = $request->getUri()->getExplodedPath();
            $count = count($parts);

            if ($parts[0] !== 'feed' || $count < 2) {
                throw new RouterException;
            }

            $feed = $this->fetchFeedQuery->execute($this->getFeedId($parts[1]));

            if ($feed === null) {
                throw new RouterException;
            }

            if ($count === 2) {
                return $this->factory->createGetFeedPageController($feed);
            }

            if ($count === 3 && $parts[2] === 'people') {
                return $this->factory->createGetFeedPeoplePageController($feed);
            }

            if ($count === 3 && $parts[2] === 'settings') {
                return $this->factory->createFeedSettingsPageController($feed);
            }

            if (!$feed['access']['post']) {
                throw new RouterException;
            }

            if ($count === 3 && $parts[2] === 'note') {
                return $this->factory->createGetCreatePostPageController($feed);
            }

            throw new RouterException;
        }

        public function canHandle(RequestInterface $request): bool
        {
            return $request instanceof \Timetabio\Framework\Http\Request\GetRequest;
        }

        private function getFeedId(string $value)
        {
            $feedId = $this->lookupVanityQuery->execute($value);

            if ($feedId !== null) {
                return $feedId;
            }

            return $value;
        }
    }
}
