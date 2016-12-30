<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class HandlerFactory extends AbstractChildFactory
    {
        use FactoryTypeHintTrait;

        public function createCommandHandler(): \Timetabio\API\Handlers\CommandHandler
        {
            return new \Timetabio\API\Handlers\CommandHandler;
        }

        public function createPostHandler(): \Timetabio\API\Handlers\PostHandler
        {
            return new \Timetabio\API\Handlers\PostHandler(
                $this->getMasterFactory()->createDataStoreWriter()
            );
        }

        public function createPreHandler(): \Timetabio\API\Handlers\PreHandler
        {
            return new \Timetabio\API\Handlers\PreHandler(
                $this->getMasterFactory()->createDataStoreReader(),
                $this->getMasterFactory()->createRequestTokenReader()
            );
        }

        public function createRequestHandler(): \Timetabio\API\Handlers\RequestHandler
        {
            return new \Timetabio\API\Handlers\RequestHandler;
        }

        public function createQueryHandler(): \Timetabio\API\Handlers\QueryHandler
        {
            return new \Timetabio\API\Handlers\QueryHandler;
        }

        public function createResponseHandler(): \Timetabio\API\Handlers\ResponseHandler
        {
            return new \Timetabio\API\Handlers\ResponseHandler;
        }

        public function createTransformationHandler(): \Timetabio\API\Handlers\TransformationHandler
        {
            return new \Timetabio\API\Handlers\TransformationHandler;
        }

        public function createGetIndexQueryHandler(): \Timetabio\API\Handlers\Get\Index\QueryHandler
        {
            return new \Timetabio\API\Handlers\Get\Index\QueryHandler;
        }

        public function createCreateUserRequestHandler(): \Timetabio\API\Handlers\Post\Users\RequestHandler
        {
            return new \Timetabio\API\Handlers\Post\Users\RequestHandler;
        }

        public function createCreateUserQueryHandler(): \Timetabio\API\Handlers\Post\Users\QueryHandler
        {
            return new \Timetabio\API\Handlers\Post\Users\QueryHandler(
                $this->getMasterFactory()->createFetchUserByEmailQuery(),
                $this->getMasterFactory()->createFetchUserByUsernameQuery(),
                $this->getMasterFactory()->createIsInvitedQuery()
            );
        }

        public function createCreateUserCommandHandler(): \Timetabio\API\Handlers\Post\Users\CommandHandler
        {
            return new \Timetabio\API\Handlers\Post\Users\CommandHandler(
                $this->getMasterFactory()->createCreateUserCommand(),
                $this->getMasterFactory()->createSendVerificationCommand(),
                $this->getMasterFactory()->createDocumentMapper()
            );
        }

        public function createVerifyRequestHandler(): \Timetabio\API\Handlers\Post\Verify\RequestHandler
        {
            return new \Timetabio\API\Handlers\Post\Verify\RequestHandler;
        }

        public function createVerifyCommandHandler(): \Timetabio\API\Handlers\Post\Verify\CommandHandler
        {
            return new \Timetabio\API\Handlers\Post\Verify\CommandHandler(
                $this->getMasterFactory()->createVerifyUserCommand()
            );
        }

        public function createVerifyQueryHandler(): \Timetabio\API\Handlers\Post\Verify\QueryHandler
        {
            return new \Timetabio\API\Handlers\Post\Verify\QueryHandler(
                $this->getMasterFactory()->createFetchVerificationTokenQuery()
            );
        }

        public function createAuthRequestHandler(): \Timetabio\API\Handlers\Post\Auth\RequestHandler
        {
            return new \Timetabio\API\Handlers\Post\Auth\RequestHandler;
        }

        public function createAuthQueryHandler(): \Timetabio\API\Handlers\Post\Auth\QueryHandler
        {
            return new \Timetabio\API\Handlers\Post\Auth\QueryHandler(
                $this->getMasterFactory()->createFetchAuthUserQuery()
            );
        }

        public function createAuthCommandHandler(): \Timetabio\API\Handlers\Post\Auth\CommandHandler
        {
            return new \Timetabio\API\Handlers\Post\Auth\CommandHandler(
                $this->getMasterFactory()->createSaveAccessTokenCommand()
            );
        }

        public function createGetUserQueryHandler(): \Timetabio\API\Handlers\Get\User\QueryHandler
        {
            return new \Timetabio\API\Handlers\Get\User\QueryHandler(
                $this->getMasterFactory()->createFetchUserByIdQuery(),
                $this->getMasterFactory()->createDocumentMapper()
            );
        }

        public function createUpdateUserRequestHandler(): \Timetabio\API\Handlers\Patch\User\RequestHandler
        {
            return new \Timetabio\API\Handlers\Patch\User\RequestHandler;
        }

        public function createUpdateUserPasswordRequestHandler(): \Timetabio\API\Handlers\Put\User\RequestHandler
        {
            return new \Timetabio\API\Handlers\Put\User\RequestHandler;
        }

        public function createUpdateUserQueryHandler(): \Timetabio\API\Handlers\Patch\User\QueryHandler
        {
            return new \Timetabio\API\Handlers\Patch\User\QueryHandler(
                $this->getMasterFactory()->createFetchUsernameQuery()
            );
        }

        public function createUpdateUserCommandHandler(): \Timetabio\API\Handlers\Patch\User\CommandHandler
        {
            return new \Timetabio\API\Handlers\Patch\User\CommandHandler(
                $this->getMasterFactory()->createUpdateUserCommand()
            );
        }

        public function createUpdateUserPasswordQueryHandler(): \Timetabio\API\Handlers\Put\User\QueryHandler
        {
            return new \Timetabio\API\Handlers\Put\User\QueryHandler(
                $this->getMasterFactory()->createFetchUserPasswordQuery()
            );
        }

        public function createUpdateUserPasswordCommandHandler(): \Timetabio\API\Handlers\Put\User\CommandHandler
        {
            return new \Timetabio\API\Handlers\Put\User\CommandHandler(
                $this->getMasterFactory()->createUpdateUserCommand()
            );
        }

        public function createGetProfileRequestHandler(): \Timetabio\API\Handlers\Get\Profile\RequestHandler
        {
            return new \Timetabio\API\Handlers\Get\Profile\RequestHandler;
        }

        public function createGetProfileQueryHandler(): \Timetabio\API\Handlers\Get\Profile\QueryHandler
        {
            return new \Timetabio\API\Handlers\Get\Profile\QueryHandler(
                $this->getMasterFactory()->createFetchProfileQuery(),
                $this->getMasterFactory()->createDocumentMapper()
            );
        }

        public function createCreateFeedRequestHandler(): \Timetabio\API\Handlers\Post\Feeds\RequestHandler
        {
            return new \Timetabio\API\Handlers\Post\Feeds\RequestHandler;
        }

        public function createCreateFeedCommandHandler(): \Timetabio\API\Handlers\Post\Feeds\CommandHandler
        {
            return new \Timetabio\API\Handlers\Post\Feeds\CommandHandler(
                $this->getMasterFactory()->createCreateFeedCommand(),
                $this->getMasterFactory()->createDocumentMapper()
            );
        }

        public function createGetFeedsQueryHandler(): \Timetabio\API\Handlers\Get\Feeds\QueryHandler
        {
            return new \Timetabio\API\Handlers\Get\Feeds\QueryHandler(
                $this->getMasterFactory()->createFetchFeedsQuery(),
                $this->getMasterFactory()->createFeedMapper()
            );
        }

        public function createGetFeedQueryHandler(): \Timetabio\API\Handlers\Get\Feed\QueryHandler
        {
            return new \Timetabio\API\Handlers\Get\Feed\QueryHandler(
                $this->getMasterFactory()->createFetchFeedQuery(),
                $this->getMasterFactory()->createFetchFeedVanityQuery(),
                $this->getMasterFactory()->createInvitationExistsQuery(),
                $this->getMasterFactory()->createFeedMapper(),
                $this->getMasterFactory()->createFeedAccessControl()
            );
        }

        public function createGetUserFeedsQueryHandler(): \Timetabio\API\Handlers\Get\User\Feeds\QueryHandler
        {
            return new \Timetabio\API\Handlers\Get\User\Feeds\QueryHandler(
                $this->getMasterFactory()->createFetchUserFeedsQuery(),
                $this->getMasterFactory()->createResultsMapper()
            );
        }

        public function createUpdateFeedRequestHandler(): \Timetabio\API\Handlers\Patch\Feed\RequestHandler
        {
            return new \Timetabio\API\Handlers\Patch\Feed\RequestHandler;
        }

        public function createUpdateFeedQueryHandler(): \Timetabio\API\Handlers\Patch\Feed\QueryHandler
        {
            return new \Timetabio\API\Handlers\Patch\Feed\QueryHandler(
                $this->getMasterFactory()->createFetchVanityByNameQuery(),
                $this->getMasterFactory()->createFeedAccessControl()
            );
        }

        public function createUpdateFeedCommandHandler(): \Timetabio\API\Handlers\Patch\Feed\CommandHandler
        {
            return new \Timetabio\API\Handlers\Patch\Feed\CommandHandler(
                $this->getMasterFactory()->createUpdateFeedCommand(),
                $this->getMasterFactory()->createSetFeedVanityCommand()
            );
        }

        public function createFollowFeedRequestHandler(): \Timetabio\API\Handlers\Post\Feed\FollowRequestHandler
        {
            return new \Timetabio\API\Handlers\Post\Feed\FollowRequestHandler;
        }

        public function createFollowFeedQueryHandler(): \Timetabio\API\Handlers\Post\Feed\Follow\QueryHandler
        {
            return new \Timetabio\API\Handlers\Post\Feed\Follow\QueryHandler(
                $this->getMasterFactory()->createFetchFollowerQuery(),
                $this->getMasterFactory()->createFeedAccessControl(),
                $this->getMasterFactory()->createFetchInvitationQuery(),
                $this->getMasterFactory()->createUserRoleLocator()
            );
        }

        public function createUnfollowFeedQueryHandler(): \Timetabio\API\Handlers\Post\Feed\Unfollow\QueryHandler
        {
            return new \Timetabio\API\Handlers\Post\Feed\Unfollow\QueryHandler(
                $this->getMasterFactory()->createFetchFollowerQuery(),
                $this->getMasterFactory()->createFeedAccessControl()
            );
        }

        public function createFollowFeedCommandHandler(): \Timetabio\API\Handlers\Post\Feed\Follow\CommandHandler
        {
            return new \Timetabio\API\Handlers\Post\Feed\Follow\CommandHandler(
                $this->getMasterFactory()->createFollowFeedCommand(),
                $this->getMasterFactory()->createDeleteInvitationCommand()
            );
        }

        public function createUnfollowFeedCommandHandler(): \Timetabio\API\Handlers\Post\Feed\Unfollow\CommandHandler
        {
            return new \Timetabio\API\Handlers\Post\Feed\Unfollow\CommandHandler(
                $this->getMasterFactory()->createUnfollowFeedCommand()
            );
        }

        public function createGetCollectionQueryHandler(): \Timetabio\API\Handlers\Get\Collection\QueryHandler
        {
            return new \Timetabio\API\Handlers\Get\Collection\QueryHandler(
                $this->getMasterFactory()->createFetchCollectionQuery(),
                $this->getMasterFactory()->createDocumentMapper(),
                $this->getMasterFactory()->createCollectionAccessControl()
            );
        }

        public function createDeleteCollectionQueryHandler(): \Timetabio\API\Handlers\Delete\Collection\QueryHandler
        {
            return new \Timetabio\API\Handlers\Delete\Collection\QueryHandler(
                $this->getMasterFactory()->createFetchCollectionQuery(),
                $this->getMasterFactory()->createDocumentMapper(),
                $this->getMasterFactory()->createCollectionAccessControl()
            );
        }

        public function createDeleteCollectionCommandHandler(): \Timetabio\API\Handlers\Delete\Collection\CommandHandler
        {
            return new \Timetabio\API\Handlers\Delete\Collection\CommandHandler(
                $this->getMasterFactory()->createDeleteCollectionCommand()
            );
        }

        public function createUpdateCollectionQueryHandler(): \Timetabio\API\Handlers\Patch\Collection\QueryHandler
        {
            return new \Timetabio\API\Handlers\Patch\Collection\QueryHandler(
                $this->getMasterFactory()->createFetchCollectionQuery(),
                $this->getMasterFactory()->createCollectionAccessControl()
            );
        }

        public function createGetCollectionRequestHandler(): \Timetabio\API\Handlers\Get\Collection\RequestHandler
        {
            return new \Timetabio\API\Handlers\Get\Collection\RequestHandler;
        }

        public function createDeleteCollectionRequestHandler(): \Timetabio\API\Handlers\Delete\Collection\RequestHandler
        {
            return new \Timetabio\API\Handlers\Delete\Collection\RequestHandler;
        }

        public function createUpdateCollectionRequestHandler(): \Timetabio\API\Handlers\Patch\Collection\RequestHandler
        {
            return new \Timetabio\API\Handlers\Patch\Collection\RequestHandler;
        }

        public function createGetUserCollectionsQueryHandler(): \Timetabio\API\Handlers\Get\User\Collections\QueryHandler
        {
            return new \Timetabio\API\Handlers\Get\User\Collections\QueryHandler(
                $this->getMasterFactory()->createFetchUserCollectionsQuery(),
                $this->getMasterFactory()->createDocumentMapper()
            );
        }

        public function createCreateCollectionRequestHandler(): \Timetabio\API\Handlers\Post\Collections\RequestHandler
        {
            return new \Timetabio\API\Handlers\Post\Collections\RequestHandler;
        }

        public function createCreateCollectionCommandHandler(): \Timetabio\API\Handlers\Post\Collections\CommandHandler
        {
            return new \Timetabio\API\Handlers\Post\Collections\CommandHandler(
                $this->getMasterFactory()->createCreateCollectionCommand(),
                $this->getMasterFactory()->createDocumentMapper()
            );
        }

        public function createUpdateCollectionCommandHandler(): \Timetabio\API\Handlers\Patch\Collection\CommandHandler
        {
            return new \Timetabio\API\Handlers\Patch\Collection\CommandHandler(
                $this->getMasterFactory()->createUpdateCollectionCommand()
            );
        }

        public function createGetRandomQueryHandler(): \Timetabio\API\Handlers\Get\Random\QueryHandler
        {
            return new \Timetabio\API\Handlers\Get\Random\QueryHandler;
        }

        public function createResendVerificationRequestHandler(): \Timetabio\API\Handlers\Post\Verify\Resend\RequestHandler
        {
            return new \Timetabio\API\Handlers\Post\Verify\Resend\RequestHandler;
        }

        public function createResendVerificationQueryHandler(): \Timetabio\API\Handlers\Post\Verify\Resend\QueryHandler
        {
            return new \Timetabio\API\Handlers\Post\Verify\Resend\QueryHandler(
                $this->getMasterFactory()->createFetchVerificationTokenByEmailQuery()
            );
        }

        public function createResendVerificationCommandHandler(): \Timetabio\API\Handlers\Post\Verify\Resend\CommandHandler
        {
            return new \Timetabio\API\Handlers\Post\Verify\Resend\CommandHandler(
                $this->getMasterFactory()->createSendVerificationCommand()
            );
        }

        public function createListRequestHandler(): \Timetabio\API\Handlers\Get\ListRequestHandler
        {
            return new \Timetabio\API\Handlers\Get\ListRequestHandler;
        }

        public function createDeleteFeedPeopleCommandHandler(): \Timetabio\API\Handlers\Delete\Feed\People\CommandHandler
        {
            return new \Timetabio\API\Handlers\Delete\Feed\People\CommandHandler(
                $this->getMasterFactory()->createDeleteFeedPersonCommand()
            );
        }

        public function createDeleteFeedPeopleQueryHandler(): \Timetabio\API\Handlers\Delete\Feed\People\QueryHandler
        {
            return new \Timetabio\API\Handlers\Delete\Feed\People\QueryHandler(
                $this->getMasterFactory()->createFetchPersonQuery(),
                $this->getMasterFactory()->createFeedAccessControl()
            );
        }

        public function createGetFeedPeopleRequestHandler(): \Timetabio\API\Handlers\Get\Feed\People\RequestHandler
        {
            return new \Timetabio\API\Handlers\Get\Feed\People\RequestHandler;
        }

        public function createGetFeedPeopleQueryHandler(): \Timetabio\API\Handlers\Get\Feed\People\QueryHandler
        {
            return new \Timetabio\API\Handlers\Get\Feed\People\QueryHandler(
                $this->getMasterFactory()->createFetchPeopleQuery(),
                $this->getMasterFactory()->createFeedAccessControl(),
                $this->getMasterFactory()->createFeedUserMapper()
            );
        }

        public function createCreatePostRequestHandler(): \Timetabio\API\Handlers\Post\Posts\RequestHandler
        {
            return new \Timetabio\API\Handlers\Post\Posts\RequestHandler(
                $this->getMasterFactory()->createPostTypeLocator()
            );
        }

        public function createCreatePostQueryHandler(): \Timetabio\API\Handlers\Post\Posts\QueryHandler
        {
            return new \Timetabio\API\Handlers\Post\Posts\QueryHandler(
                $this->getMasterFactory()->createFeedAccessControl(),
                $this->getMasterFactory()->createFetchFileByPublicIdQuery()
            );
        }

        public function createCreatePostCommandHandler(): \Timetabio\API\Handlers\Post\Posts\CommandHandler
        {
            return new \Timetabio\API\Handlers\Post\Posts\CommandHandler(
                $this->getMasterFactory()->createCreatePostCommand(),
                $this->getMasterFactory()->createPostMapper()
            );
        }

        public function createGetFeedPostsQueryHandler(): \Timetabio\API\Handlers\Get\Feed\Posts\QueryHandler
        {
            return new \Timetabio\API\Handlers\Get\Feed\Posts\QueryHandler(
                $this->getMasterFactory()->createFetchFeedPostsQuery(),
                $this->getMasterFactory()->createFeedAccessControl(),
                $this->getMasterFactory()->createResultsMapper()
            );
        }

        public function createGetPostQueryHandler(): \Timetabio\API\Handlers\Get\Post\QueryHandler
        {
            return new \Timetabio\API\Handlers\Get\Post\QueryHandler(
                $this->getMasterFactory()->createFetchPostQuery(),
                $this->getMasterFactory()->createFetchPostAttachmentsQuery(),
                $this->getMasterFactory()->createPostMapper(),
                $this->getMasterFactory()->createPostAttachmentMapper(),
                $this->getMasterFactory()->createFeedAccessControl()
            );
        }

        public function createGetUserUpcomingQueryHandler(): \Timetabio\API\Handlers\Get\User\Upcoming\QueryHandler
        {
            return new \Timetabio\API\Handlers\Get\User\Upcoming\QueryHandler(
                $this->getMasterFactory()->createFetchUpcomingEventsQuery(),
                $this->getMasterFactory()->createPostMapper()
            );
        }

        public function createGetUserTodoQueryHandler(): \Timetabio\API\Handlers\Get\User\Todo\QueryHandler
        {
            return new \Timetabio\API\Handlers\Get\User\Todo\QueryHandler(
                $this->getMasterFactory()->createFetchUserTodoTasksQuery(),
                $this->getMasterFactory()->createPostMapper()
            );
        }

        public function createDeletePostCommandHandler(): \Timetabio\API\Handlers\Delete\Post\CommandHandler
        {
            return new \Timetabio\API\Handlers\Delete\Post\CommandHandler(
                $this->getMasterFactory()->createDeletePostCommand()
            );
        }

        public function createDeletePostQueryHandler(): \Timetabio\API\Handlers\Delete\Post\QueryHandler
        {
            return new \Timetabio\API\Handlers\Delete\Post\QueryHandler(
                $this->getMasterFactory()->createFetchPostInfoQuery(),
                $this->getMasterFactory()->createFeedAccessControl()
            );
        }

        public function createCreateFeedUploadRequestHandler(): \Timetabio\API\Handlers\Post\Feed\Upload\RequestHandler
        {
            return new \Timetabio\API\Handlers\Post\Feed\Upload\RequestHandler;
        }

        public function createCreateFeedUploadCommandHandler(): \Timetabio\API\Handlers\Post\Feed\Upload\CommandHandler
        {
            return new \Timetabio\API\Handlers\Post\Feed\Upload\CommandHandler(
                $this->getMasterFactory()->createCreateFeedUploadUrlCommand(),
                $this->getMasterFactory()->createCreateFileCommand()
            );
        }

        public function createRevokeCommandHandler(): \Timetabio\API\Handlers\Post\Revoke\CommandHandler
        {
            return new \Timetabio\API\Handlers\Post\Revoke\CommandHandler(
                $this->getMasterFactory()->createDeleteAccessTokenCommand()
            );
        }

        public function createCreateBetaRequestRequestHandler(): \Timetabio\API\Handlers\Post\BetaRequest\RequestHandler
        {
            return new \Timetabio\API\Handlers\Post\BetaRequest\RequestHandler;
        }

        public function createCreateBetaRequestCommandHandler(): \Timetabio\API\Handlers\Post\BetaRequest\CommandHandler
        {
            return new \Timetabio\API\Handlers\Post\BetaRequest\CommandHandler(
                $this->getMasterFactory()->createCreateBetaRequestCommand()
            );
        }

        public function createCreateBetaRequestQueryHandler(): \Timetabio\API\Handlers\Post\BetaRequest\QueryHandler
        {
            return new \Timetabio\API\Handlers\Post\BetaRequest\QueryHandler(
                $this->getMasterFactory()->createFetchBetaRequestByEmailQuery()
            );
        }

        public function createCreateFeedInvitationRequestHandler(): \Timetabio\API\Handlers\Post\Feed\Invitations\RequestHandler
        {
            return new \Timetabio\API\Handlers\Post\Feed\Invitations\RequestHandler(
                $this->getMasterFactory()->createUserRoleLocator()
            );
        }

        public function createCreateFeedInvitationQueryHandler(): \Timetabio\API\Handlers\Post\Feed\Invitations\QueryHandler
        {
            return new \Timetabio\API\Handlers\Post\Feed\Invitations\QueryHandler(
                $this->getMasterFactory()->createFeedAccessControl(),
                $this->getMasterFactory()->createInvitationExistsQuery(),
                $this->getMasterFactory()->createFetchFeedUserQuery(),
                $this->getMasterFactory()->createFetchUserByUsernameQuery()
            );
        }

        public function createCreateFeedInvitationCommandHandler(): \Timetabio\API\Handlers\Post\Feed\Invitations\CommandHandler
        {
            return new \Timetabio\API\Handlers\Post\Feed\Invitations\CommandHandler(
                $this->getMasterFactory()->createCreateInvitationCommand(),
                $this->getMasterFactory()->createDocumentMapper()
            );
        }

        public function createGetFeedInvitationsQueryHandler(): \Timetabio\API\Handlers\Get\Feed\Invitations\QueryHandler
        {
            return new \Timetabio\API\Handlers\Get\Feed\Invitations\QueryHandler(
                $this->getMasterFactory()->createFeedAccessControl(),
                $this->getMasterFactory()->createFetchInvitationsQuery(),
                $this->getMasterFactory()->createFeedUserMapper()
            );
        }

        public function createUpdateFeedInvitationRequestHandler(): \Timetabio\API\Handlers\Patch\Feed\Invitation\RequestHandler
        {
            return new \Timetabio\API\Handlers\Patch\Feed\Invitation\RequestHandler(
                $this->getMasterFactory()->createUserRoleLocator()
            );
        }

        public function createUpdateFeedInvitationQueryHandler(): \Timetabio\API\Handlers\Patch\Feed\Invitation\QueryHandler
        {
            return new \Timetabio\API\Handlers\Patch\Feed\Invitation\QueryHandler(
                $this->getMasterFactory()->createFeedAccessControl(),
                $this->getMasterFactory()->createFetchInvitationQuery()
            );
        }

        public function createUpdateFeedInvitationCommandHandler(): \Timetabio\API\Handlers\Patch\Feed\Invitation\CommandHandler
        {
            return new \Timetabio\API\Handlers\Patch\Feed\Invitation\CommandHandler(
                $this->getMasterFactory()->createUpdateInvitationCommand()
            );
        }

        public function createDeleteFeedInvitationQueryHandler(): \Timetabio\API\Handlers\Delete\Feed\Invitation\QueryHandler
        {
            return new \Timetabio\API\Handlers\Delete\Feed\Invitation\QueryHandler(
                $this->getMasterFactory()->createFeedAccessControl(),
                $this->getMasterFactory()->createFetchInvitationQuery()
            );
        }

        public function createDeleteFeedInvitationCommandHandler(): \Timetabio\API\Handlers\Delete\Feed\Invitation\CommandHandler
        {
            return new \Timetabio\API\Handlers\Delete\Feed\Invitation\CommandHandler(
                $this->getMasterFactory()->createDeleteInvitationCommand()
            );
        }

        public function createUpdateFeedUserRequestHandler(): \Timetabio\API\Handlers\Patch\Feed\User\RequestHandler
        {
            return new \Timetabio\API\Handlers\Patch\Feed\User\RequestHandler(
                $this->getMasterFactory()->createUserRoleLocator()
            );
        }

        public function createUpdateFeedUserQueryHandler(): \Timetabio\API\Handlers\Patch\Feed\User\QueryHandler
        {
            return new \Timetabio\API\Handlers\Patch\Feed\User\QueryHandler(
                $this->getMasterFactory()->createFeedAccessControl(),
                $this->getMasterFactory()->createFetchFeedUserQuery()
            );
        }

        public function createUpdateFeedUserCommandHandler(): \Timetabio\API\Handlers\Patch\Feed\User\CommandHandler
        {
            return new \Timetabio\API\Handlers\Patch\Feed\User\CommandHandler(
                $this->getMasterFactory()->createUpdateFeedUserCommand()
            );
        }

        public function createSearchRequestHandler(): \Timetabio\API\Handlers\Get\Search\RequestHandler
        {
            return new \Timetabio\API\Handlers\Get\Search\RequestHandler(
                $this->getMasterFactory()->createSearchTypeLocator()
            );
        }

        public function createSearchQueryHandler(): \Timetabio\API\Handlers\Get\Search\QueryHandler
        {
            return new \Timetabio\API\Handlers\Get\Search\QueryHandler(
                $this->getMasterFactory()->createSearchQuery(),
                $this->getMasterFactory()->createSearchResultsMapper()
            );
        }

        public function createGetUserFeedQueryHandler(): \Timetabio\API\Handlers\Get\User\Feed\QueryHandler
        {
            return new \Timetabio\API\Handlers\Get\User\Feed\QueryHandler(
                $this->getMasterFactory()->createFetchUserFeedQuery(),
                $this->getMasterFactory()->createResultsMapper()
            );
        }

        public function createArchivePostQueryHandler(): \Timetabio\API\Handlers\Post\Post\Archive\QueryHandler
        {
            return new \Timetabio\API\Handlers\Post\Post\Archive\QueryHandler(
                $this->getMasterFactory()->createFetchPostInfoQuery(),
                $this->getMasterFactory()->createFeedAccessControl()
            );
        }

        public function createArchivePostCommandHandler(): \Timetabio\API\Handlers\Post\Post\Archive\CommandHandler
        {
            return new \Timetabio\API\Handlers\Post\Post\Archive\CommandHandler(
                $this->getMasterFactory()->createArchivePostCommand()
            );
        }
    }
}
