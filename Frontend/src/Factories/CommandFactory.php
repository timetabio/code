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
    use Timetabio\Frontend\Commands;

    class CommandFactory extends AbstractChildFactory
    {
        use FactoryTypeHintTrait;

        public function createWriteSessionCommand(): \Timetabio\Frontend\Commands\WriteSessionCommand
        {
            return new \Timetabio\Frontend\Commands\WriteSessionCommand(
                $this->getMasterFactory()->createDataStoreWriter()
            );
        }

        public function createLoginCommand(): \Timetabio\Frontend\Commands\LoginCommand
        {
            return new \Timetabio\Frontend\Commands\LoginCommand(
                $this->getMasterFactory()->createApiGateway(),
                $this->getMasterFactory()->createSession()
            );
        }

        public function createCreateFeedCommand(): \Timetabio\Frontend\Commands\CreateFeedCommand
        {
            return new \Timetabio\Frontend\Commands\CreateFeedCommand(
                $this->getMasterFactory()->createApiGateway()
            );
        }

        public function createCreateNoteCommand(): \Timetabio\Frontend\Commands\CreateNoteCommand
        {
            return new \Timetabio\Frontend\Commands\CreateNoteCommand(
                $this->getMasterFactory()->createApiGateway()
            );
        }

        public function createResendVerificationCommand(): \Timetabio\Frontend\Commands\ResendVerificationCommand
        {
            return new \Timetabio\Frontend\Commands\ResendVerificationCommand(
                $this->getMasterFactory()->createApiGateway()
            );
        }

        public function createLogoutCommand(): \Timetabio\Frontend\Commands\LogoutCommand
        {
            return new \Timetabio\Frontend\Commands\LogoutCommand(
                $this->getMasterFactory()->createSession(),
                $this->getMasterFactory()->createApiGateway()
            );
        }

        public function createFollowFeedCommand(): \Timetabio\Frontend\Commands\Feed\FollowFeedCommand
        {
            return new \Timetabio\Frontend\Commands\Feed\FollowFeedCommand(
                $this->getMasterFactory()->createApiGateway()
            );
        }

        public function createUnfollowFeedCommand(): \Timetabio\Frontend\Commands\Feed\UnfollowFeedCommand
        {
            return new \Timetabio\Frontend\Commands\Feed\UnfollowFeedCommand(
                $this->getMasterFactory()->createApiGateway()
            );
        }

        public function createRegisterCommand(): \Timetabio\Frontend\Commands\RegisterCommand
        {
            return new \Timetabio\Frontend\Commands\RegisterCommand(
                $this->getMasterFactory()->createApiGateway()
            );
        }

        public function createVerifyCommand(): \Timetabio\Frontend\Commands\VerifyCommand
        {
            return new \Timetabio\Frontend\Commands\VerifyCommand(
                $this->getMasterFactory()->createApiGateway()
            );
        }

        public function createDeletePostCommand(): \Timetabio\Frontend\Commands\DeletePostCommand
        {
            return new \Timetabio\Frontend\Commands\DeletePostCommand(
                $this->getMasterFactory()->createApiGateway()
            );
        }

        public function createCreateUploadCommand(): \Timetabio\Frontend\Commands\CreateUploadCommand
        {
            return new \Timetabio\Frontend\Commands\CreateUploadCommand(
                $this->getMasterFactory()->createApiGateway()
            );
        }

        public function createCreateBetaRequestCommand(): \Timetabio\Frontend\Commands\CreateBetaRequestCommand
        {
            return new \Timetabio\Frontend\Commands\CreateBetaRequestCommand(
                $this->getMasterFactory()->createApiGateway()
            );
        }

        public function createDeleteFeedUserCommand(): \Timetabio\Frontend\Commands\DeleteFeedUserCommand
        {
            return new \Timetabio\Frontend\Commands\DeleteFeedUserCommand(
                $this->getMasterFactory()->createApiGateway()
            );
        }

        public function createInviteFeedUserCommand(): \Timetabio\Frontend\Commands\InviteFeedUserCommand
        {
            return new \Timetabio\Frontend\Commands\InviteFeedUserCommand(
                $this->getMasterFactory()->createApiGateway()
            );
        }

        public function createDeleteFeedInvitationCommand(): Commands\Feed\DeleteFeedInvitationCommand
        {
            return new Commands\Feed\DeleteFeedInvitationCommand(
                $this->getMasterFactory()->createApiGateway()
            );
        }

        public function createUpdateFeedUserRoleCommand(): Commands\Feed\UpdateFeedUserRoleCommand
        {
            return new Commands\Feed\UpdateFeedUserRoleCommand(
                $this->getMasterFactory()->createApiGateway()
            );
        }

        public function createUpdateFeedNameCommand(): Commands\Feed\UpdateFeedNameCommand
        {
            return new Commands\Feed\UpdateFeedNameCommand(
                $this->getMasterFactory()->createApiGateway()
            );
        }
    }
}
