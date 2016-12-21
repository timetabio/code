<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Access\AccessControl
{
    use Timetabio\API\ValueObjects\AccessToken;

    class CollectionAccessControl extends AbstractAccessControl
    {
        public function hasReadAccess(AccessToken $accessToken, array $collection): bool
        {
            $userId = (string) $accessToken->getUserId();

            if ($collection['owner_id'] === (string) $userId) {
                return $this->checkScope($accessToken, 'collections:read');
            }

            return false;
        }

        public function hasWriteAccess(AccessToken $accessToken, array $collection): bool
        {
            $userId = (string) $accessToken->getUserId();

            if ($collection['owner_id'] === (string) $userId) {
                return $this->checkScope($accessToken, 'collections:write');
            }

            return false;
        }
    }
}
