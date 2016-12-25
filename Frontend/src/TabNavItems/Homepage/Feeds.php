<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\TabNavItems\Homepage
{
    use Timetabio\Frontend\TabNavItems\TabNavItem;
    use Timetabio\Frontend\Tabs\Tab;

    class Feeds implements TabNavItem
    {
        public function getTab(): Tab
        {
            return new \Timetabio\Frontend\Tabs\Homepage\Feeds;
        }

        public function getUri(): string
        {
            return '/feeds';
        }

        public function getIcon(): string
        {
           return 'feed';
        }

        public function getLabel(): string
        {
            return 'Feeds';
        }
    }
}
