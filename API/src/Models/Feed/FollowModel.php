<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Models\Feed
{
    use Timetabio\Library\UserRoles\UserRole;

    class FollowModel extends FeedModel
    {
        /**
         * @var bool
         */
        private $following = false;

        /**
         * @var UserRole
         */
        private $role;

        public function __construct()
        {
            $this->role = new \Timetabio\Library\UserRoles\DefaultUserRole;
        }

        public function isFollowing(): bool
        {
            return $this->following;
        }

        public function setFollowing(bool $following)
        {
            $this->following = $following;
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
