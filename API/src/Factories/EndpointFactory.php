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

    class EndpointFactory extends AbstractChildFactory
    {
        public function createGetIndexEndpoint(): \Timetabio\API\Endpoints\Index\GetIndexEndpoint
        {
            return new \Timetabio\API\Endpoints\Index\GetIndexEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createCreateUserEndpoint(): \Timetabio\API\Endpoints\Users\CreateUserEndpoint
        {
            return new \Timetabio\API\Endpoints\Users\CreateUserEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createAuthEndpoint(): \Timetabio\API\Endpoints\AuthEndpoint
        {
            return new \Timetabio\API\Endpoints\AuthEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createVerifyEndpoint(): \Timetabio\API\Endpoints\Verify\VerifyEndpoint
        {
            return new \Timetabio\API\Endpoints\Verify\VerifyEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createGetUserEndpoint(): \Timetabio\API\Endpoints\User\GetUserEndpoint
        {
            return new \Timetabio\API\Endpoints\User\GetUserEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createUpdateUserEndpoint(): \Timetabio\API\Endpoints\User\UpdateUserEndpoint
        {
            return new \Timetabio\API\Endpoints\User\UpdateUserEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createUpdateUserPasswordEndpoint(): \Timetabio\API\Endpoints\User\UpdateUserPasswordEndpoint
        {
            return new \Timetabio\API\Endpoints\User\UpdateUserPasswordEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createGetProfileEndpoint(): \Timetabio\API\Endpoints\Profiles\GetProfileEndpoint
        {
            return new \Timetabio\API\Endpoints\Profiles\GetProfileEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createGetCollectionEndpoint(): \Timetabio\API\Endpoints\Collections\GetCollectionEndpoint
        {
            return new \Timetabio\API\Endpoints\Collections\GetCollectionEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createUpdateCollectionEndpoint(): \Timetabio\API\Endpoints\Collections\UpdateCollectionEndpoint
        {
            return new \Timetabio\API\Endpoints\Collections\UpdateCollectionEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createDeleteCollectionEndpoint(): \Timetabio\API\Endpoints\Collections\DeleteCollectionEndpoint
        {
            return new \Timetabio\API\Endpoints\Collections\DeleteCollectionEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createCreateFeedEndpoint(): \Timetabio\API\Endpoints\Feeds\CreateFeedEndpoint
        {
            return new \Timetabio\API\Endpoints\Feeds\CreateFeedEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createCreateCollectionEndpoint(): \Timetabio\API\Endpoints\Collections\CreateCollectionEndpoint
        {
            return new \Timetabio\API\Endpoints\Collections\CreateCollectionEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createGetFeedsEndpoint(): \Timetabio\API\Endpoints\Feeds\GetFeedsEndpoint
        {
            return new \Timetabio\API\Endpoints\Feeds\GetFeedsEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createGetFeedEndpoint(): \Timetabio\API\Endpoints\Feeds\GetFeedEndpoint
        {
            return new \Timetabio\API\Endpoints\Feeds\GetFeedEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createGetUserFeedsEndpoint(): \Timetabio\API\Endpoints\User\GetUserFeedsEndpoint
        {
            return new \Timetabio\API\Endpoints\User\GetUserFeedsEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createUpdateFeedEndpoint(): \Timetabio\API\Endpoints\Feeds\UpdateFeedEndpoint
        {
            return new \Timetabio\API\Endpoints\Feeds\UpdateFeedEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createFollowFeedEndpoint(): \Timetabio\API\Endpoints\Feeds\FollowFeedEndpoint
        {
            return new \Timetabio\API\Endpoints\Feeds\FollowFeedEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createUnfollowFeedEndpoint(): \Timetabio\API\Endpoints\Feeds\UnfollowFeedEndpoint
        {
            return new \Timetabio\API\Endpoints\Feeds\UnfollowFeedEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createGetRandomEndpoint(): \Timetabio\API\Endpoints\Random\GetRandomEndpoint
        {
            return new \Timetabio\API\Endpoints\Random\GetRandomEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createResendVerificationEndpoint(): \Timetabio\API\Endpoints\Verify\ResendEndpoint
        {
            return new \Timetabio\API\Endpoints\Verify\ResendEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createGetUserCollectionsEndpoint(): \Timetabio\API\Endpoints\User\GetUserCollectionsEndpoint
        {
            return new \Timetabio\API\Endpoints\User\GetUserCollectionsEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createDeleteFeedUserEndpoint(): \Timetabio\API\Endpoints\Feeds\DeleteFeedUserEndpoint
        {
            return new \Timetabio\API\Endpoints\Feeds\DeleteFeedUserEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createGetFeedUsersEndpoint(): \Timetabio\API\Endpoints\Feeds\GetFeedUsersEndpoint
        {
            return new \Timetabio\API\Endpoints\Feeds\GetFeedUsersEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createCreatePostEndpoint(): \Timetabio\API\Endpoints\Posts\CreatePostEndpoint
        {
            return new \Timetabio\API\Endpoints\Posts\CreatePostEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createDeletePostEndpoint(): \Timetabio\API\Endpoints\Posts\DeletePostEndpoint
        {
            return new \Timetabio\API\Endpoints\Posts\DeletePostEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createGetPostEndpoint(): \Timetabio\API\Endpoints\Posts\GetPostEndpoint
        {
            return new \Timetabio\API\Endpoints\Posts\GetPostEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createGetPostsEndpoint(): \Timetabio\API\Endpoints\Posts\GetPostsEndpoint
        {
            return new \Timetabio\API\Endpoints\Posts\GetPostsEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createUpdatePostEndpoint(): \Timetabio\API\Endpoints\Posts\UpdatePostEndpoint
        {
            return new \Timetabio\API\Endpoints\Posts\UpdatePostEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createGetUpcomingEndpoint(): \Timetabio\API\Endpoints\User\GetUpcomingEndpoint
        {
            return new \Timetabio\API\Endpoints\User\GetUpcomingEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createGetUserTodoEndpoint(): \Timetabio\API\Endpoints\User\GetTodoEndpoint
        {
            return new \Timetabio\API\Endpoints\User\GetTodoEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createCreateFeedUploadUrlEndpoint(): \Timetabio\API\Endpoints\Feeds\CreateUploadEndpoint
        {
            return new \Timetabio\API\Endpoints\Feeds\CreateUploadEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createRevokeEndpoint(): \Timetabio\API\Endpoints\RevokeEndpoint
        {
            return new \Timetabio\API\Endpoints\RevokeEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createCreateBetaRequestEndpoint(): \Timetabio\API\Endpoints\BetaRequest\CreateBetaRequestEndpoint
        {
            return new \Timetabio\API\Endpoints\BetaRequest\CreateBetaRequestEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createCreateFeedInvitationEndpoint(): \Timetabio\API\Endpoints\Feeds\CreateInvitationEndpoint
        {
            return new \Timetabio\API\Endpoints\Feeds\CreateInvitationEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createGetFeedInvitationsEndpoint(): \Timetabio\API\Endpoints\Feeds\GetFeedInvitationsEndpoint
        {
            return new \Timetabio\API\Endpoints\Feeds\GetFeedInvitationsEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createUpdateFeedInvitationEndpoint(): \Timetabio\API\Endpoints\Feeds\UpdateFeedInvitationEndpoint
        {
            return new \Timetabio\API\Endpoints\Feeds\UpdateFeedInvitationEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createDeleteFeedInvitationEndpoint(): \Timetabio\API\Endpoints\Feeds\DeleteFeedInvitationEndpoint
        {
            return new \Timetabio\API\Endpoints\Feeds\DeleteFeedInvitationEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createUpdateFeedUserEndpoint(): \Timetabio\API\Endpoints\Feeds\UpdateFeedUserEndpoint
        {
            return new \Timetabio\API\Endpoints\Feeds\UpdateFeedUserEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createSearchEndpoint(): \Timetabio\API\Endpoints\SearchEndpoint
        {
            return new \Timetabio\API\Endpoints\SearchEndpoint(
                $this->getMasterFactory()
            );
        }

        public function createGetUserFeedEndpoint(): \Timetabio\API\Endpoints\User\GetUserFeedEndpoint
        {
            return new \Timetabio\API\Endpoints\User\GetUserFeedEndpoint(
                $this->getMasterFactory()
            );
        }
    }
}
