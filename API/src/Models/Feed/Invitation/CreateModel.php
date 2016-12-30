<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Models\Feed\Invitation
{
    use Timetabio\API\Models\APIModel;
    use Timetabio\Library\UserRoles\UserRole;

    class CreateModel extends APIModel
    {
        /**
         * @var string
         */
        private $invitationFeedId;

        /**
         * @var string
         */
        private $invitationUsername;

        /**
         * @var string
         */
        private $invitationUserId;

        /**
         * @var UserRole
         */
        private $invitationUserRole;

        public function getInvitationFeedId(): string
        {
            return $this->invitationFeedId;
        }

        public function setInvitationFeedId(string $invitationFeedId)
        {
            $this->invitationFeedId = $invitationFeedId;
        }

        public function getInvitationUsername(): string
        {
            return $this->invitationUsername;
        }

        public function setInvitationUsername(string $invitationUsername)
        {
            $this->invitationUsername = $invitationUsername;
        }

        public function getInvitationUserId(): string
        {
            return $this->invitationUserId;
        }

        public function setInvitationUserId(string $invitationUserId)
        {
            $this->invitationUserId = $invitationUserId;
        }

        public function getInvitationUserRole(): UserRole
        {
            return $this->invitationUserRole;
        }

        public function setInvitationUserRole(UserRole $invitationUserRole)
        {
            $this->invitationUserRole = $invitationUserRole;
        }
    }
}
