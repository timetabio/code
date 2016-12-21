<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class RouterFactory extends AbstractChildFactory
    {
        use FactoryTypeHintTrait;

        public function createStaticPageRouter(): \Timetabio\Frontend\Routers\StaticPageRouter
        {
            return new \Timetabio\Frontend\Routers\StaticPageRouter(
                $this->getMasterFactory(),
                $this->getMasterFactory()->createDataStoreReader()
            );
        }

        public function createNotFoundRouter(): \Timetabio\Frontend\Routers\NotFoundRouter
        {
            return new \Timetabio\Frontend\Routers\NotFoundRouter(
                $this->getMasterFactory()
            );
        }

        public function createActionRouter(): \Timetabio\Frontend\Routers\ActionRouter
        {
            return new \Timetabio\Frontend\Routers\ActionRouter(
                $this->getMasterFactory()
            );
        }

        public function createUserActionRouter(): \Timetabio\Frontend\Routers\UserActionRouter
        {
            return new \Timetabio\Frontend\Routers\UserActionRouter(
                $this->getMasterFactory(),
                $this->getMasterFactory()->createIsLoggedInQuery()
            );
        }

        public function createPageRouter(): \Timetabio\Frontend\Routers\PageRouter
        {
            return new \Timetabio\Frontend\Routers\PageRouter(
                $this->getMasterFactory(),
                $this->getMasterFactory()->createIsLoggedInQuery()
            );
        }

        public function createUserPageRouter(): \Timetabio\Frontend\Routers\UserPageRouter
        {
            return new \Timetabio\Frontend\Routers\UserPageRouter(
                $this->getMasterFactory(),
                $this->getMasterFactory()->createIsLoggedInQuery()
            );
        }

        public function createFeedPageRouter(): \Timetabio\Frontend\Routers\FeedPageRouter
        {
            return new \Timetabio\Frontend\Routers\FeedPageRouter(
                $this->getMasterFactory(),
                $this->getMasterFactory()->createFetchFeedQuery(),
                $this->getMasterFactory()->createLookupVanityQuery(),
                $this->getMasterFactory()->createIsLoggedInQuery()
            );
        }

        public function createPostPageRouter(): \Timetabio\Frontend\Routers\PostPageRouter
        {
            return new \Timetabio\Frontend\Routers\PostPageRouter(
                $this->getMasterFactory(),
                $this->getMasterFactory()->createFetchPostQuery()
            );
        }

        public function createFragmentRouter(): \Timetabio\Frontend\Routers\FragmentRouter
        {
            return new \Timetabio\Frontend\Routers\FragmentRouter(
                $this->getMasterFactory()
            );
        }

        public function createUserFragmentRouter(): \Timetabio\Frontend\Routers\UserFragmentRouter
        {
            return new \Timetabio\Frontend\Routers\UserFragmentRouter(
                $this->getMasterFactory(),
                $this->getMasterFactory()->createIsLoggedInQuery()
            );
        }
    }
}
