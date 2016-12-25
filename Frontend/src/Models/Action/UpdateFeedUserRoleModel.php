<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
