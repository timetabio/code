<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\TabNavItems\Homepage
{
    use Timetabio\Frontend\TabNavItems\TabNavItem;
    use Timetabio\Frontend\Tabs\Tab;

    class Posts implements TabNavItem
    {
        public function getTab(): Tab
        {
            return new \Timetabio\Frontend\Tabs\Homepage\Posts;
        }

        public function getUri(): string
        {
            return '/';
        }

        public function getIcon(): string
        {
           return 'note';
        }

        public function getLabel(): string
        {
            return 'Posts';
        }
    }
}
