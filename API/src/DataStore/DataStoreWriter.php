<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\DataStore
{
    use Timetabio\API\ValueObjects\AccessToken;
    use Timetabio\Framework\ValueObjects\Token;
    use Timetabio\Library\DataStore\AbstractDataStoreWriter;

    class DataStoreWriter extends AbstractDataStoreWriter
    {
        public function saveAccessToken(AccessToken $token)
        {
            $key = 'access_token_' . $token->getToken();

            $this->getDataStore()->set(
                $key,
                serialize($token)
            );

            $this->getDataStore()->setTimeout($key, $token->getExpires());
        }

        public function renewAccessToken(AccessToken $token)
        {
            $this->getDataStore()->setTimeout('access_token_' . $token->getToken(), $token->getExpires());
        }

        public function removeAccessToken(AccessToken $token)
        {
            $this->getDataStore()->remove('access_token_' . $token->getToken());
        }

        public function saveResetToken(string $userId, Token $token)
        {
            $key = 'reset_token:' . $token;

            $this->getDataStore()->set($key, $userId);
            $this->getDataStore()->setTimeout($key, 7200);
        }

        public function removeResetToken(string $token)
        {
            $this->getDataStore()->remove('reset_token:' . $token);
        }

        /**
         * @deprecated
         */
        public function setFeedOwner(string $feedId, string $userId)
        {
            $this->getDataStore()->set('feed_access_owner_' . $feedId, $userId);
        }

        /**
         * @deprecated
         */
        public function setPrivateFeed(string $feedId)
        {
            $this->getDataStore()->set('feed_access_is_private_' . $feedId, 1);
        }

        /**
         * @deprecated
         */
        public function addFeedReadAccess(string $feedId, string $userId)
        {
            $this->getDataStore()->addToSet('feed_access_read_' . $feedId, $userId);
        }

        /**
         * @deprecated
         */
        public function addFeedPostAccess(string $feedId, string $userId)
        {
            $this->getDataStore()->addToSet('feed_access_post_' . $feedId, $userId);
        }

        /**
         * @deprecated
         */
        public function removeFeedReadAccess(string $feedId, string $userId)
        {
            $this->getDataStore()->removeFromSet('feed_access_read_' . $feedId, $userId);
        }

        /**
         * @deprecated
         */
        public function removeFeedPostAccess(string $feedId, string $userId)
        {
            $this->getDataStore()->removeFromSet('feed_access_post_' . $feedId, $userId);
        }

        /**
         * @deprecated
         */
        public function setPostBody(string $postId, string $body)
        {
            $this->getDataStore()->set('post_body:' . $postId, $body);
        }

        /**
         * @deprecated
         */
        public function setPostPreview(string $postId, string $body)
        {
            $this->getDataStore()->set('post_preview:' . $postId, $body);
        }

        /**
         * @deprecated
         */
        public function setPostText(string $postId, string $body)
        {
            $this->getDataStore()->set('post_text:' . $postId, $body);
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

        /**
         * @deprecated
         */
        public function removeVanity(string $feedId)
        {
            $key = 'feed_vanity:' . $feedId;

            if (!$this->getDataStore()->has($key)) {
                return;
            }

            $vanity = $this->getDataStore()->get($key);

            $this->getDataStore()->remove($key);
            $this->getDataStore()->remove('vanity_feed:' . mb_strtolower($vanity));
        }
    }
}
