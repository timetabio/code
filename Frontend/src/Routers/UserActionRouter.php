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

    class UserActionRouter implements RouterInterface
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
                case '/action/account/feeds/new':
                    return $this->factory->createNewFeedController();
                case '/action/logout':
                    return $this->factory->createLogoutController();
                case '/action/note/create':
                    return $this->factory->createCreateNoteController();
                case '/action/follow':
                    return $this->factory->createFollowController();
                case '/action/unfollow':
                    return $this->factory->createUnfollowController();
                case '/action/posts/delete':
                    return $this->factory->createDeletePostController();
                case '/action/feed/delete-user':
                    return $this->factory->createDeleteFeedUserController();
                case '/action/feed/update-user':
                    return $this->factory->createUpdateFeedUserRoleController();
                case '/action/feed/invite-user':
                    return $this->factory->createInviteFeedUserController();
                case '/action/feed/delete-invitation':
                    return $this->factory->createDeleteFeedInvitationController();
                case '/action/feed/update-name':
                    return $this->factory->createUpdateFeedNameController();
                case '/action/upload':
                    return $this->factory->createCreateUploadController();
            }

            throw new RouterException;
        }

        public function canHandle(RequestInterface $request): bool
        {
            return $request instanceof \Timetabio\Framework\Http\Request\PostRequest;
        }
    }
}
