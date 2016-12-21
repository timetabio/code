<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Models\Action
{
    use Timetabio\Frontend\Models\ActionModel;

    class UpdateFeedUserRoleModel extends ActionModel
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
         * @var string
         */
        private $role;

        public function getFeedId(): string
        {
            return $this->feedId;
        }

        public function setFeedId(string $feedId)
        {
            $this->feedId = $feedId;
        }

        public function getUserId(): string
        {
            return $this->userId;
        }

        public function setUserId(string $userId)
        {
            $this->userId = $userId;
        }

        public function getRole(): string
        {
            return $this->role;
        }

        public function setRole(string $role)
        {
            $this->role = $role;
        }
    }
}
