<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
