<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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

        public function __construct(string $feedId, string $userId)
        {
            parent::__construct($feedId);

            $this->userId = $userId;
        }

        public function getUserId(): string
        {
            return $this->userId;
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
