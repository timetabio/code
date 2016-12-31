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
    use Timetabio\Library\Tasks\TaskInterface;
    use Timetabio\Library\UserRoles\{
        Moderator, Owner, UserRole
    };

    class AbstractDataStoreWriter
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

        public function removeFeedAccess(string $feedId, string $userId): void
        {
            $this->dataStore->removeFromSet('feed_access_read:' . $feedId, $userId);
            $this->dataStore->removeFromSet('feed_access_post:' . $feedId, $userId);
            $this->dataStore->removeFromSet('feed_access_write:' . $feedId, $userId);
        }

        public function setFeedAccess(string $feedId, string $userId, UserRole $role): void
        {
            $this->dataStore->addToSet('feed_access_read:' . $feedId, $userId);

            if ($role instanceof Moderator) {
                $this->dataStore->addToSet('feed_access_post:' . $feedId, $userId);
            }

            if ($role instanceof Owner) {
                $this->dataStore->addToSet('feed_access_write:' . $feedId, $userId);
            }
        }

        public function addPrivateFeed(string $feedId): void
        {
            $this->dataStore->addToSet('private_feeds', $feedId);
        }

        public function addFeed(string $feedId): void
        {
            $this->getDataStore()->addToSet('feeds', $feedId);
        }

        public function queueTask(TaskInterface $task): void
        {
            $score = time() - $task->getPriority()->getValue();
            $value = serialize($task);

            if ($this->getDataStore()->hasInSet('task_queue', $value)) {
                return;
            }

            $this->getDataStore()->zAdd('task_queue', $score, $value);
        }

        public function setVanity(string $feedId, string $vanity): void
        {
            $this->getDataStore()->set('vanity_feed:' . mb_strtolower($vanity), $feedId);
            $this->getDataStore()->set('feed_vanity:' . $feedId, $vanity);
        }

        public function setUserFeeds(string $userId, array $feeds): void
        {
            $this->getDataStore()->set('user_feeds:' . $userId, serialize($feeds));
        }

        /**
         * @deprecated
         */
        public function removePostBody(string $postId)
        {
            $this->getDataStore()->remove('post_body:' . $postId);
        }

        /**
         * @deprecated
         */
        public function removePostPreview(string $postId)
        {
            $this->getDataStore()->remove('post_preview:' . $postId);
        }

        /**
         * @deprecated
         */
        public function removePostText(string $postId)
        {
            $this->getDataStore()->remove('post_text:' . $postId);
        }
    }
}
