<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\UserRoles
{
    class Moderator extends DefaultUserRole
    {
        public function getLabel(): string
        {
            return 'Moderator';
        }

        public function __toString(): string
        {
            return 'moderator';
        }
    }
}
