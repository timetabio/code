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
    use Timetabio\Library\DataStore\AbstractDataStoreReader;

    class DataStoreReader extends AbstractDataStoreReader
    {
        public function hasAccessToken(string $token): bool
        {
            return $this->getDataStore()->has('access_token_' . $token);
        }

        public function getAccessToken(string $token): AccessToken
        {
            return unserialize($this->getDataStore()->get('access_token_' . $token));
        }

        public function hasResetToken(string $token): bool
        {
            return $this->getDataStore()->has('reset_token:' . $token);
        }

        public function getResetToken(string $token): string
        {
            return $this->getDataStore()->get('reset_token:' . $token);
        }

        /**
         * @deprecated
         */
        public function isFeedPrivate(string $feedId): bool
        {
            return $this->getDataStore()->has('feed_access_is_private_' . $feedId);
        }

        /**
         * @deprecated
         */
        public function isFeedOwner(string $feedId, string $userId): bool
        {
            return $this->getDataStore()->get('feed_access_owner_' . $feedId) === $userId;
        }
    }
}
