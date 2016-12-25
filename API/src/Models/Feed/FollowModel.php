<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
