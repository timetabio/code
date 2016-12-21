<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
