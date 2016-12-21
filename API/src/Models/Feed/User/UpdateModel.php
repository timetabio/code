<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Models\Feed\User
{
    use Timetabio\API\Models\Feed\FeedModel;
    use Timetabio\Library\UserRoles\UserRole;

    class UpdateModel extends FeedModel
    {
        /**
         * @var string
         */
        private $userId;

        /**
         * @var UserRole
         */
        private $role;

        public function getUserId(): string
        {
            return $this->userId;
        }

        public function setUserId(string $userId)
        {
            $this->userId = $userId;
        }

        public function getRole(): UserRole
        {
            return $this->role;
        }

        public function setRole(UserRole $role)
        {
            $this->role = $role;
        }
    }
}
