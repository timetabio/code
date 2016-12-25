<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Library\Locators
{
    class UserRoleLocator
    {
        public function locate(string $role): \Timetabio\Library\UserRoles\UserRole
        {
            switch($role) {
                case 'default':
                    return new \Timetabio\Library\UserRoles\DefaultUserRole;
                case 'moderator':
                    return new \Timetabio\Library\UserRoles\Moderator;
                case 'owner':
                    return new \Timetabio\Library\UserRoles\Owner;
            }

            throw new \Exception('unable to locate role "' . $role . '"');
        }
    }
}
