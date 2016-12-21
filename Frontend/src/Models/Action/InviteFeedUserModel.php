<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Models\Action
{
    use Timetabio\Frontend\Models\ActionModel;

    class InviteFeedUserModel extends ActionModel
    {
        /**
         * @var string
         */
        private $feedId;

        /**
         * @var string
         */
        private $username;

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

        public function getUsername(): string
        {
            return $this->username;
        }

        public function setUsername(string $username)
        {
            $this->username = $username;
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
