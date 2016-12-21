<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
