<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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

        public function createVerifyAccountPageRouter(): \Timetabio\Frontend\Routers\VerifyAccountPageRouter
        {
            return new \Timetabio\Frontend\Routers\VerifyAccountPageRouter(
                $this->getMasterFactory(),
                $this->getMasterFactory()->createVerifyCommand()
            );
        }

        public function createResetPasswordPageRouter(): \Timetabio\Frontend\Routers\ResetPasswordPageRouter
        {
            return new \Timetabio\Frontend\Routers\ResetPasswordPageRouter(
                $this->getMasterFactory()
            );
        }
    }
}
