<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
