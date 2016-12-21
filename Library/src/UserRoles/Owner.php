<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\UserRoles
{
    class Owner extends Moderator
    {
        public function getLabel(): string
        {
            return 'Owner';
        }

        public function __toString(): string
        {
            return 'owner';
        }
    }
}
