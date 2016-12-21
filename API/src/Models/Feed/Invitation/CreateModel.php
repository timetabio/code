<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Models\Feed\Invitation
{
    use Timetabio\API\Models\APIModel;
    use Timetabio\Library\DataObjects\FeedInvitation;
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
