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

    class HandlerFactory extends AbstractChildFactory
    {
        use FactoryTypeHintTrait;

        public function createRequestHandler(): \Timetabio\Frontend\Handlers\RequestHandler
        {
            return new \Timetabio\Frontend\Handlers\RequestHandler;
        }

        public function createCommandHandler(): \Timetabio\Frontend\Handlers\CommandHandler
        {
            return new \Timetabio\Frontend\Handlers\CommandHandler;
        }

        public function createPostHandler(): \Timetabio\Frontend\Handlers\PostHandler
        {
            return new \Timetabio\Frontend\Handlers\PostHandler(
                $this->getMasterFactory()->createSession(),
                $this->getMasterFactory()->createWriteSessionCommand()
            );
        }

        public function createPreHandler(): \Timetabio\Frontend\Handlers\PreHandler
        {
            return new \Timetabio\Frontend\Handlers\PreHandler(
                $this->getMasterFactory()->createSession()
            );
        }

        public function createQueryHandler(): \Timetabio\Frontend\Handlers\QueryHandler
        {
            return new \Timetabio\Frontend\Handlers\QueryHandler;
        }

        public function createResponseHandler(): \Timetabio\Frontend\Handlers\ResponseHandler
        {
            return new \Timetabio\Frontend\Handlers\ResponseHandler(
                $this->getMasterFactory()->createSession()
            );
        }

        public function createGetPageTransformationHandler(): \Timetabio\Frontend\Handlers\Get\Page\TransformationHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\Page\TransformationHandler(
                $this->getMasterFactory()->createStaticPageRenderer()
            );
        }

        public function createGetPagePreHandler(): \Timetabio\Frontend\Handlers\Get\Page\PreHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\Page\PreHandler(
                $this->getMasterFactory()->createSession()
            );
        }

        public function createGetStaticPageQueryHandler(): \Timetabio\Frontend\Handlers\Get\StaticPage\QueryHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\StaticPage\QueryHandler(
                $this->getMasterFactory()->createFetchStaticPageQuery()
            );
        }

        public function createPostTransformationHandler(): \Timetabio\Frontend\Handlers\Post\TransformationHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\TransformationHandler;
        }

        public function createPostPreHandler(): \Timetabio\Frontend\Handlers\Post\PreHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\PreHandler(
                $this->getMasterFactory()->createSession()
            );
        }

        public function createPostRegisterRequestHandler(): \Timetabio\Frontend\Handlers\Post\Register\RequestHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\Register\RequestHandler(
                $this->getMasterFactory()->createSession()
            );
        }

        public function createPostRegisterCommandHandler(): \Timetabio\Frontend\Handlers\Post\Register\CommandHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\Register\CommandHandler(
                $this->getMasterFactory()->createRegisterCommand()
            );
        }

        public function createLoginRequestHandler(): \Timetabio\Frontend\Handlers\Post\Login\RequestHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\Login\RequestHandler(
                $this->getMasterFactory()->createSession()
            );
        }

        public function createResendVerificationRequestHandler(): \Timetabio\Frontend\Handlers\Post\ResendVerification\RequestHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\ResendVerification\RequestHandler(
                $this->getMasterFactory()->createSession());
        }

        public function createResendVerificationCommandHandler(): \Timetabio\Frontend\Handlers\Post\ResendVerification\CommandHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\ResendVerification\CommandHandler(
                $this->getMasterFactory()->createResendVerificationCommand()
            );
        }

        public function createLoginCommandHandler(): \Timetabio\Frontend\Handlers\Post\Login\CommandHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\Login\CommandHandler(
                $this->getMasterFactory()->createLoginCommand()
            );
        }

        public function createLogoutCommandHandler(): \Timetabio\Frontend\Handlers\Post\Logout\CommandHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\Logout\CommandHandler(
                $this->getMasterFactory()->createLogoutCommand()
            );
        }

        public function createGetVerifyAccountRequestHandler(): \Timetabio\Frontend\Handlers\Get\Account\Verify\RequestHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\Account\Verify\RequestHandler;
        }

        public function createGetVerifyAccountCommandHandler(): \Timetabio\Frontend\Handlers\Get\Account\Verify\CommandHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\Account\Verify\CommandHandler(
                $this->getMasterFactory()->createVerifyCommand()
            );
        }

        public function createGetVerifyAccountTransformationHandler(): \Timetabio\Frontend\Handlers\Get\Page\TransformationHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\Page\TransformationHandler(
                $this->getMasterFactory()->createVerifyAccountPageRenderer()
            );
        }

        public function createGetHomepageQueryHandler(): \Timetabio\Frontend\Handlers\Get\Homepage\QueryHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\Homepage\QueryHandler(
                $this->getMasterFactory()->createFetchUserFeedQuery()
            );
        }

        public function createGetHomepageTransformationHandler(): \Timetabio\Frontend\Handlers\Get\Page\TransformationHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\Page\TransformationHandler(
                $this->getMasterFactory()->createHomepageRenderer()
            );
        }

        public function createFeedsPageQueryHandler(): \Timetabio\Frontend\Handlers\Get\FeedsPage\QueryHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\FeedsPage\QueryHandler(
                $this->getMasterFactory()->createFetchUserFeedsQuery()
            );
        }

        public function createFeedsPageTransformationHandler(): \Timetabio\Frontend\Handlers\Get\Page\TransformationHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\Page\TransformationHandler(
                $this->getMasterFactory()->createFeedsPageRenderer()
            );
        }

        public function createNewFeedCommandHandler(): \Timetabio\Frontend\Handlers\Post\NewFeed\CommandHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\NewFeed\CommandHandler(
                $this->getMasterFactory()->createCreateFeedCommand(),
                $this->getMasterFactory()->createUriBuilder()
            );
        }

        public function createNewFeedRequestHandler(): \Timetabio\Frontend\Handlers\Post\NewFeed\RequestHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\NewFeed\RequestHandler;
        }

        public function createGetFeedPageQueryHandler(): \Timetabio\Frontend\Handlers\Get\FeedPage\QueryHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\FeedPage\QueryHandler(
                $this->getMasterFactory()->createFetchFeedPostsQuery(),
                $this->getMasterFactory()->createUriBuilder()
            );
        }

        public function createGetFeedPageTransformationHandler(): \Timetabio\Frontend\Handlers\Get\Page\TransformationHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\Page\TransformationHandler(
                $this->getMasterFactory()->createFeedPageRenderer()
            );
        }

        public function createGetCreatePostPageQueryHandler(): \Timetabio\Frontend\Handlers\Get\CreatePostPage\QueryHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\CreatePostPage\QueryHandler;
        }

        public function createGetCreatePostPageTransformationHandler(): \Timetabio\Frontend\Handlers\Get\Page\TransformationHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\Page\TransformationHandler(
                $this->getMasterFactory()->createCreatePostPageRenderer()
            );
        }

        public function createCreateNoteCommandHandler(): \Timetabio\Frontend\Handlers\Post\CreateNote\CommandHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\CreateNote\CommandHandler(
                $this->getMasterFactory()->createCreateNoteCommand(),
                $this->getMasterFactory()->createUriBuilder()
            );
        }

        public function createCreateNoteRequestHandler(): \Timetabio\Frontend\Handlers\Post\CreateNote\RequestHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\CreateNote\RequestHandler;
        }

        public function createFollowRequestHandler(): \Timetabio\Frontend\Handlers\Post\Follow\RequestHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\Follow\RequestHandler;
        }

        public function createFollowCommandHandler(): \Timetabio\Frontend\Handlers\Post\Follow\CommandHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\Follow\CommandHandler(
                $this->getMasterFactory()->createFollowFeedCommand()
            );
        }

        public function createUnfollowCommandHandler(): \Timetabio\Frontend\Handlers\Post\Unfollow\CommandHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\Unfollow\CommandHandler(
                $this->getMasterFactory()->createUnfollowFeedCommand()
            );
        }

        public function createDeletePostRequestHandler(): \Timetabio\Frontend\Handlers\Post\DeletePost\RequestHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\DeletePost\RequestHandler;
        }

        public function createDeletePostCommandHandler(): \Timetabio\Frontend\Handlers\Post\DeletePost\CommandHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\DeletePost\CommandHandler(
                $this->getMasterFactory()->createDeletePostCommand(),
                $this->getMasterFactory()->createUriBuilder()
            );
        }

        public function createCreateUploadRequestHandler(): \Timetabio\Frontend\Handlers\Post\Upload\RequestHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\Upload\RequestHandler;
        }

        public function createCreateUploadCommandHandler(): \Timetabio\Frontend\Handlers\Post\Upload\CommandHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\Upload\CommandHandler(
                $this->getMasterFactory()->createCreateUploadCommand()
            );
        }

        public function createGetPostPageQueryHandler(): \Timetabio\Frontend\Handlers\Get\PostPage\QueryHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\PostPage\QueryHandler(
                $this->getMasterFactory()->createFetchFeedPostsQuery()
            );
        }

        public function createGetPostPageTransformationHandler(): \Timetabio\Frontend\Handlers\Get\Page\TransformationHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\Page\TransformationHandler(
                $this->getMasterFactory()->createPostPageRenderer()
            );
        }

        public function createCreateBetaRequestCommandHandler(): \Timetabio\Frontend\Handlers\Post\CreateBetaRequest\CommandHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\CreateBetaRequest\CommandHandler(
                $this->getMasterFactory()->createCreateBetaRequestCommand()
            );
        }

        public function createCreateBetaRequestRequestHandler(): \Timetabio\Frontend\Handlers\Post\CreateBetaRequest\RequestHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\CreateBetaRequest\RequestHandler;
        }

        public function createSearchPageRequestHandler(): \Timetabio\Frontend\Handlers\Get\SearchPage\RequestHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\SearchPage\RequestHandler;
        }

        public function createSearchPageQueryHandler(): \Timetabio\Frontend\Handlers\Get\SearchPage\QueryHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\SearchPage\QueryHandler(
                $this->getMasterFactory()->createSearchQuery(),
                $this->getMasterFactory()->createSearchTabLocator()
            );
        }

        public function createSearchPageTransformationHandler(): \Timetabio\Frontend\Handlers\Get\Page\TransformationHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\Page\TransformationHandler(
                $this->getMasterFactory()->createSearchPageRenderer()
            );
        }

        public function createGetFeedPostsFragmentQueryHandler(): \Timetabio\Frontend\Handlers\Get\FeedPostsFragment\QueryHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\FeedPostsFragment\QueryHandler(
                $this->getMasterFactory()->createFetchFeedQuery(),
                $this->getMasterFactory()->createFetchFeedPostsQuery()
            );
        }

        public function createGetFeedPostsFragmentRequestHandler(): \Timetabio\Frontend\Handlers\Get\FeedPostsFragment\RequestHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\FeedPostsFragment\RequestHandler;
        }

        public function createGetFeedPostsFragmentTransformationHandler(): \Timetabio\Frontend\Handlers\Get\Fragment\TransformationHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\Fragment\TransformationHandler(
                $this->getMasterFactory()->createFeedPostsFragmentRenderer()
            );
        }

        public function createGetHomepagePostsFragmentQueryHandler(): \Timetabio\Frontend\Handlers\Get\HomepagePostsFragment\QueryHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\HomepagePostsFragment\QueryHandler(
                $this->getMasterFactory()->createFetchUserFeedQuery()
            );
        }

        public function createGetHomepagePostsFragmentRequestHandler(): \Timetabio\Frontend\Handlers\Get\HomepagePostsFragment\RequestHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\HomepagePostsFragment\RequestHandler;
        }

        public function createGetHomepagePostsFragmentTransformationHandler(): \Timetabio\Frontend\Handlers\Get\Fragment\TransformationHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\Fragment\TransformationHandler(
                $this->getMasterFactory()->createHomepagePostsFragmentRenderer()
            );
        }

        public function createGetFeedPeoplePageQueryHandler(): \Timetabio\Frontend\Handlers\Get\FeedPeoplePage\QueryHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\FeedPeoplePage\QueryHandler(
                $this->getMasterFactory()->createFetchFeedUsersQuery(),
                $this->getMasterFactory()->createFetchFeedInvitationsQuery()
            );
        }

        public function createGetFeedPeoplePageRequestHandler(): \Timetabio\Frontend\Handlers\Get\FeedPeoplePage\RequestHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\FeedPeoplePage\RequestHandler;
        }

        public function createGetFeedPeoplePageTransformationHandler(): \Timetabio\Frontend\Handlers\Get\Page\TransformationHandler
        {
            return new \Timetabio\Frontend\Handlers\Get\Page\TransformationHandler(
                $this->getMasterFactory()->createFeedPeoplePageRenderer()
            );
        }

        public function createDeleteFeedUserCommandHandler(): \Timetabio\Frontend\Handlers\Post\DeleteFeedUser\CommandHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\DeleteFeedUser\CommandHandler(
                $this->getMasterFactory()->createDeleteFeedUserCommand()
            );
        }

        public function createDeleteFeedUserRequestHandler(): \Timetabio\Frontend\Handlers\Post\DeleteFeedUser\RequestHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\DeleteFeedUser\RequestHandler;
        }

        public function createInviteFeedUserCommandHandler(): \Timetabio\Frontend\Handlers\Post\InviteFeedUser\CommandHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\InviteFeedUser\CommandHandler(
                $this->getMasterFactory()->createInviteFeedUserCommand()
            );
        }

        public function createInviteFeedUserRequestHandler(): \Timetabio\Frontend\Handlers\Post\InviteFeedUser\RequestHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\InviteFeedUser\RequestHandler;
        }

        public function createDeleteFeedInvitationCommandHandler(): \Timetabio\Frontend\Handlers\Post\DeleteFeedInvitation\CommandHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\DeleteFeedInvitation\CommandHandler(
                $this->getMasterFactory()->createDeleteFeedInvitationCommand()
            );
        }

        public function createDeleteFeedInvitationRequestHandler(): \Timetabio\Frontend\Handlers\Post\DeleteFeedInvitation\RequestHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\DeleteFeedInvitation\RequestHandler;
        }

        public function createUpdateFeedUserRoleCommandHandler(): \Timetabio\Frontend\Handlers\Post\UpdateFeedUserRole\CommandHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\UpdateFeedUserRole\CommandHandler(
                $this->getMasterFactory()->createUpdateFeedUserRoleCommand()
            );
        }

        public function createUpdateFeedUserRoleRequestHandler(): \Timetabio\Frontend\Handlers\Post\UpdateFeedUserRole\RequestHandler
        {
            return new \Timetabio\Frontend\Handlers\Post\UpdateFeedUserRole\RequestHandler;
        }
    }
}
