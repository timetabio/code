<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\UserRoles
{
    interface UserRole
    {
        public function getLabel(): string;

        public function __toString(): string;
    }
}
