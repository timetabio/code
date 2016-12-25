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
