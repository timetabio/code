<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Library\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class LocatorFactory extends AbstractChildFactory
    {
        public function createUserRoleLocator(): \Timetabio\Library\Locators\UserRoleLocator
        {
            return new \Timetabio\Library\Locators\UserRoleLocator;
        }

        public function createSearchTypeLocator(): \Timetabio\Library\Locators\SearchTypeLocator
        {
            return new \Timetabio\Library\Locators\SearchTypeLocator;
        }
    }
}
