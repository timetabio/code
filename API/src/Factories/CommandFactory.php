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

    class CommandFactory extends AbstractChildFactory
    {
        use FactoryTypeHintTrait;

        public function createCreateUserCommand(): \Timetabio\API\Commands\User\CreateUserCommand
        {
            return new \Timetabio\API\Commands\User\CreateUserCommand(
                $this->getMasterFactory()->createUserService()
            );
        }

        public function createVerifyUserCommand(): \Timetabio\API\Commands\User\VerifyUserCommand
        {
            return new \Timetabio\API\Commands\User\VerifyUserCommand(
                $this->getMasterFactory()->createUserService()
            );
        }

        public function createSaveAccessTokenCommand(): \Timetabio\API\Commands\SaveAccessTokenCommand
        {
            return new \Timetabio\API\Commands\SaveAccessTokenCommand(
                $this->getMasterFactory()->createDataStoreWriter()
            );
        }

        public function createSendVerificationCommand(): \Timetabio\API\Commands\SendVerificationCommand
        {
            return new \Timetabio\API\Commands\SendVerificationCommand(
                $this->getMasterFactory()->createDataStoreWriter()
            );
        }

        public function createUpdateUserCommand(): \Timetabio\API\Commands\User\UpdateUserCommand
        {
            return new \Timetabio\API\Commands\User\UpdateUserCommand(
                $this->getMasterFactory()->createUserService()
            );
        }

        public function createCreateCollectionCommand(): \Timetabio\API\Commands\CreateCollectionCommand
        {
            return new \Timetabio\API\Commands\CreateCollectionCommand(
                $this->getMasterFactory()->createCollectionService()
            );
        }

        public function createDeleteCollectionCommand(): \Timetabio\API\Commands\DeleteCollectionCommand
        {
            return new \Timetabio\API\Commands\DeleteCollectionCommand(
                $this->getMasterFactory()->createCollectionService()
            );
        }

        public function createUpdateCollectionCommand(): \Timetabio\API\Commands\UpdateCollectionCommand
        {
            return new \Timetabio\API\Commands\UpdateCollectionCommand(
                $this->getMasterFactory()->createCollectionService()
            );
        }

        public function createCreateFeedCommand(): \Timetabio\API\Commands\CreateFeedCommand
        {
            return new \Timetabio\API\Commands\CreateFeedCommand(
                $this->getMasterFactory()->createFeedService(),
                $this->getMasterFactory()->createDataStoreWriter()
            );
        }

        public function createUpdateFeedCommand(): \Timetabio\API\Commands\Feeds\UpdateFeedCommand
        {
            return new \Timetabio\API\Commands\Feeds\UpdateFeedCommand(
                $this->getMasterFactory()->createFeedService(),
                $this->getMasterFactory()->createDataStoreWriter()
            );
        }

        public function createFollowFeedCommand(): \Timetabio\API\Commands\Feeds\FollowFeedCommand
        {
            return new \Timetabio\API\Commands\Feeds\FollowFeedCommand(
                $this->getMasterFactory()->createFollowerService(),
                $this->getMasterFactory()->createDataStoreWriter()
            );
        }

        public function createUnfollowFeedCommand(): \Timetabio\API\Commands\Feeds\UnfollowFeedCommand
        {
            return new \Timetabio\API\Commands\Feeds\UnfollowFeedCommand(
                $this->getMasterFactory()->createFollowerService(),
                $this->getMasterFactory()->createDataStoreWriter()
            );
        }

        public function createCreateFeedPersonCommand(): \Timetabio\API\Commands\Feeds\CreateFeedPersonCommand
        {
            return new \Timetabio\API\Commands\Feeds\CreateFeedPersonCommand(
                $this->getMasterFactory()->createPeopleService(),
                $this->getMasterFactory()->createDataStoreWriter()
            );
        }

        public function createDeleteFeedPersonCommand(): \Timetabio\API\Commands\Feeds\DeleteFeedPersonCommand
        {
            return new \Timetabio\API\Commands\Feeds\DeleteFeedPersonCommand(
                $this->getMasterFactory()->createPeopleService(),
                $this->getMasterFactory()->createDataStoreWriter()
            );
        }

        public function createCreatePostCommand(): \Timetabio\API\Commands\Posts\CreatePostCommand
        {
            return new \Timetabio\API\Commands\Posts\CreatePostCommand(
                $this->getMasterFactory()->createInkBackend(),
                $this->getMasterFactory()->createPostService(),
                $this->getMasterFactory()->createDataStoreWriter()
            );
        }

        public function createDeletePostCommand(): \Timetabio\API\Commands\Posts\DeletePostCommand
        {
            return new \Timetabio\API\Commands\Posts\DeletePostCommand(
                $this->getMasterFactory()->createPostService(),
                $this->getMasterFactory()->createDataStoreWriter()
            );
        }

        public function createSetFeedVanityCommand(): \Timetabio\API\Commands\Feed\SetFeedVanityCommand
        {
            return new \Timetabio\API\Commands\Feed\SetFeedVanityCommand(
                $this->getMasterFactory()->createFeedService(),
                $this->getMasterFactory()->createDataStoreWriter()
            );
        }

        public function createCreateFeedUploadUrlCommand(): \Timetabio\API\Commands\Feed\CreateFeedUploadUrlCommand
        {
            return new \Timetabio\API\Commands\Feed\CreateFeedUploadUrlCommand(
                $this->getMasterFactory()->createAwsS3Backend()
            );
        }

        public function createCreateFileCommand(): \Timetabio\API\Commands\File\CreateFileCommand
        {
            return new \Timetabio\API\Commands\File\CreateFileCommand(
                $this->getMasterFactory()->createFileService()
            );
        }

        public function createDeleteAccessTokenCommand(): \Timetabio\API\Commands\DeleteAccessTokenCommand
        {
            return new \Timetabio\API\Commands\DeleteAccessTokenCommand(
                $this->getMasterFactory()->createDataStoreWriter()
            );
        }

        public function createCreateBetaRequestCommand(): \Timetabio\API\Commands\BetaRequest\CreateBetaRequestCommand
        {
            return new \Timetabio\API\Commands\BetaRequest\CreateBetaRequestCommand(
                $this->getMasterFactory()->createBetaRequestService(),
                $this->getMasterFactory()->createDataStoreWriter()
            );
        }

        public function createCreateInvitationCommand(): \Timetabio\API\Commands\Feed\CreateInvitationCommand
        {
            return new \Timetabio\API\Commands\Feed\CreateInvitationCommand(
                $this->getMasterFactory()->createFeedInvitationService(),
                $this->getMasterFactory()->createDataStoreWriter()
            );
        }

        public function createDeleteInvitationCommand(): \Timetabio\API\Commands\Feed\DeleteInvitationCommand
        {
            return new \Timetabio\API\Commands\Feed\DeleteInvitationCommand(
                $this->getMasterFactory()->createFeedInvitationService()
            );
        }

        public function createUpdateInvitationCommand(): \Timetabio\API\Commands\Feed\UpdateInvitationCommand
        {
            return new \Timetabio\API\Commands\Feed\UpdateInvitationCommand(
                $this->getMasterFactory()->createFeedInvitationService()
            );
        }

        public function createUpdateFeedUserCommand(): \Timetabio\API\Commands\Feed\UpdateFeedUserCommand
        {
            return new \Timetabio\API\Commands\Feed\UpdateFeedUserCommand(
                $this->getMasterFactory()->createFeedService(),
                $this->getMasterFactory()->createDataStoreWriter()
            );
        }

        public function createUpdateUserPasswordCommand(): \Timetabio\API\Commands\User\UpdateUserPasswordCommand
        {
            return new \Timetabio\API\Commands\User\UpdateUserPasswordCommand(
                $this->getMasterFactory()->createUserService()
            );
        }

        public function createArchivePostCommand(): \Timetabio\API\Commands\Posts\ArchivePostCommand
        {
            return new \Timetabio\API\Commands\Posts\ArchivePostCommand(
                $this->getMasterFactory()->createPostService(),
                $this->getMasterFactory()->createElasticBackend()
            );
        }

        public function createRestorePostCommand(): \Timetabio\API\Commands\Posts\RestorePostCommand
        {
            return new \Timetabio\API\Commands\Posts\RestorePostCommand(
                $this->getMasterFactory()->createPostService(),
                $this->getMasterFactory()->createElasticBackend(),
                $this->getMasterFactory()->createDataStoreWriter()
            );
        }

        public function createUpdatePostBodyCommand(): \Timetabio\API\Commands\Posts\UpdatePostBodyCommand
        {
            return new \Timetabio\API\Commands\Posts\UpdatePostBodyCommand(
                $this->getMasterFactory()->createInkBackend(),
                $this->getMasterFactory()->createPostService(),
                $this->getMasterFactory()->createDataStoreWriter()
            );
        }

        public function createUpdatePostTitleCommand(): \Timetabio\API\Commands\Posts\UpdatePostTitleCommand
        {
            return new \Timetabio\API\Commands\Posts\UpdatePostTitleCommand(
                $this->getMasterFactory()->createPostService(),
                $this->getMasterFactory()->createDataStoreWriter()
            );
        }
    }
}
