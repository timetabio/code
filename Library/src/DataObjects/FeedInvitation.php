<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\DataObjects
{
    use Timetabio\Library\UserRoles\UserRole;

    class FeedInvitation
    {
        /**
         * @var string
         */
        private $feedId;

        /**
         * @var string
         */
        private $userId;

        /**
         * @var UserRole
         */
        private $userRole;

        public function __construct($feedId, $userId, UserRole $userRole)
        {
            $this->feedId = $feedId;
            $this->userId = $userId;
            $this->userRole = $userRole;
        }

        public function getFeedId(): string
        {
            return $this->feedId;
        }

        public function getUserId(): string
        {
            return $this->userId;
        }

        public function getUserRole(): UserRole
        {
            return $this->userRole;
        }
    }
}
