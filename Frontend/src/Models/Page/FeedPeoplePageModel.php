<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Models\Page
{
    use Timetabio\Frontend\Tabs\Tab;

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

        public function getActiveTab(): Tab
        {
            return new \Timetabio\Frontend\Tabs\FeedPage\People;
        }
    }
}
