<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Access\AccessControl
{
    use Timetabio\API\Access\AccessTypes\FullAccess;
    use Timetabio\API\Access\AccessTypes\ScopedAccess;
    use Timetabio\API\ValueObjects\AccessToken;

    abstract class AbstractAccessControl
    {
        protected function checkScope(AccessToken $accessToken, string $scope): bool
        {
            $accessType = $accessToken->getAccessType();

            if ($accessType instanceof FullAccess) {
                return true;
            }

            if ($accessType instanceof ScopedAccess) {
                return $accessType->hasScope($scope);
            }

            return false;
        }
    }
}
