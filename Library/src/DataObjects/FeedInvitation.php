<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
