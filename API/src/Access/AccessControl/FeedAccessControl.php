<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Access\AccessControl
{
    use Timetabio\API\DataStore\DataStoreReader;
    use Timetabio\API\ValueObjects\AccessToken;

    class FeedAccessControl extends AbstractAccessControl
    {
        /**
         * @var DataStoreReader
         */
        private $dataStoreReader;

        public function __construct(DataStoreReader $dataStoreReader)
        {
            $this->dataStoreReader = $dataStoreReader;
        }

        public function hasReadAccess(string $feedId, AccessToken $accessToken = null): bool
        {
            if (!$this->dataStoreReader->hasFeed($feedId)) {
                return false;
            }

            if (!$this->dataStoreReader->isPrivateFeed($feedId)) {
                return true;
            }

            if ($accessToken === null) {
                return false;
            }

            $userId = (string) $accessToken->getUserId();

            if ($this->dataStoreReader->hasFeedReadAccess($feedId, $userId)) {
                return $this->checkScope($accessToken, 'feeds:read');
            }

            return false;
        }

        public function hasFollowAccess(string $feedId, AccessToken $accessToken): bool
        {
            if (!$this->dataStoreReader->hasFeed($feedId)) {
                return false;
            }

            if (!$this->dataStoreReader->isPrivateFeed($feedId)) {
                return true;
            }

            $userId = (string) $accessToken->getUserId();

            if ($this->dataStoreReader->hasFeedReadAccess($feedId, $userId)) {
                return $this->checkScope($accessToken, 'feeds:read');
            }

            return false;
        }

        public function hasWriteAccess(string $feedId, AccessToken $accessToken = null): bool
        {
            if ($accessToken === null) {
                return false;
            }

            if ($this->dataStoreReader->hasFeedWriteAccess($feedId, $accessToken->getUserId())) {
                return $this->checkScope($accessToken, 'feeds:write');
            }

            return false;
        }

        public function hasPostAccess(string $feedId, AccessToken $accessToken = null): bool
        {
            if ($accessToken === null) {
                return false;
            }

            $userId = (string) $accessToken->getUserId();

            if ($this->dataStoreReader->hasFeedPostAccess($feedId, $userId)) {
                return $this->checkScope($accessToken, 'feeds:post');
            }

            return false;
        }

        public function canModifyFeedUser(string $feedId, string $userId, AccessToken $accessToken = null): bool
        {
            if ($accessToken === null) {
                return false;
            }

            if (!$this->hasWriteAccess($feedId, $accessToken)) {
                return false;
            }

            if ((string) $accessToken->getUserId() === $userId) {
                return false;
            }

            // Check if the target user is not an owner
            if (!$this->dataStoreReader->hasFeedWriteAccess($feedId, $userId)) {
                return true;
            }

            // Last owner cannot be deleted
            return $this->dataStoreReader->countFeedWriteAccess($feedId) > 1;
        }

        public function canUnfollow(string $feedId, AccessToken $accessToken = null): bool
        {
            if ($accessToken === null) {
                return false;
            }

            // Check if the target user is not an owner
            if (!$this->dataStoreReader->hasFeedWriteAccess($feedId, $accessToken->getUserId())) {
                return true;
            }

            // Last owner cannot unfollow
            return $this->dataStoreReader->countFeedWriteAccess($feedId) > 1;
        }
    }
}
