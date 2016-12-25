<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Library\DataStore
{
    use Timetabio\Framework\DataStore\DataStoreInterface;

    class AbstractDataStoreReader
    {
        /**
         * @var DataStoreInterface
         */
        private $dataStore;

        public function __construct(DataStoreInterface $dataStore)
        {
            $this->dataStore = $dataStore;
        }

        protected function getDataStore(): DataStoreInterface
        {
            return $this->dataStore;
        }

        public function hasPostBody(string $postId): bool
        {
            return $this->dataStore->has('post_body:' . $postId);
        }

        public function getPostBody(string $postId): string
        {
            return $this->dataStore->get('post_body:' . $postId);
        }

        public function hasPostPreview(string $postId): bool
        {
            return $this->dataStore->has('post_preview:' . $postId);
        }

        public function getPostPreview(string $postId): string
        {
            return $this->dataStore->get('post_preview:' . $postId);
        }

        public function hasFeedVanity(string $feedId): bool
        {
            return $this->dataStore->has('feed_vanity:' . $feedId);
        }

        public function getFeedVanity(string $feedId): ?string
        {
            return $this->dataStore->get('feed_vanity:' . $feedId);
        }

        public function hasVanity(string $vanity): bool
        {
            return $this->dataStore->has('vanity_feed:' . mb_strtolower($vanity));
        }

        public function getFeedByVanity(string $vanity): string
        {
            return $this->dataStore->get('vanity_feed:' . mb_strtolower($vanity));
        }

        public function hasFeedReadAccess(string $feedId, string $userId)
        {
            return $this->dataStore->hasInSet('feed_access_read:' . $feedId, $userId);
        }

        public function hasFeedPostAccess(string $feedId, string $userId)
        {
            return $this->dataStore->hasInSet('feed_access_post:' . $feedId, $userId);
        }

        public function hasFeedWriteAccess(string $feedId, string $userId)
        {
            return $this->dataStore->hasInSet('feed_access_write:' . $feedId, $userId);
        }

        public function countFeedWriteAccess(string $feedId)
        {
            return $this->dataStore->sCard('feed_access_write:' . $feedId);
        }

        public function isPrivateFeed(string $feedId)
        {
            return $this->dataStore->hasInSet('private_feeds', $feedId);
        }

        public function hasFeed(string $feedId): bool
        {
            return $this->dataStore->hasInSet('feeds', $feedId);
        }

        public function hasUserFeeds(string $userId): bool
        {
            return $this->getDataStore()->has('user_feeds:' . $userId);
        }

        public function getUserFeeds(string $userId): array
        {
            return unserialize($this->getDataStore()->get('user_feeds:' . $userId));
        }
    }
}
