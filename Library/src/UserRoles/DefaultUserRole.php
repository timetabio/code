<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\UserRoles
{
    class DefaultUserRole implements UserRole
    {
        public function getLabel(): string
        {
            return 'Default';
        }

        public function __toString(): string
        {
            return 'default';
        }
    }
}
