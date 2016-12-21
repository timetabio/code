<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Models\Page
{
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Frontend\ValueObjects\Feed;

    class FeedPeoplePageModel extends FeedPageModel
    {
        /**
         * @var array
         */
        private $feedInvitations;

        /**
         * @var array
         */
        private $feedUsers;

        public function getFeedInvitations(): array
        {
            return $this->feedInvitations;
        }

        public function setFeedInvitations(array $feedInvitations)
        {
            $this->feedInvitations = $feedInvitations;
        }

        public function hasFeedUsers(): bool
        {
            return $this->feedUsers !== null;
        }

        public function getFeedUsers(): array
        {
            return $this->feedUsers;
        }

        public function setFeedUsers(array $feedUsers)
        {
            $this->feedUsers = $feedUsers;
        }
    }
}
