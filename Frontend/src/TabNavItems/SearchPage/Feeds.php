<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\TabNavItems\SearchPage
{
    use Timetabio\Frontend\TabNavItems\AbstractTabNavItem;
    use Timetabio\Frontend\Tabs\Tab;

    class Feeds extends AbstractTabNavItem
    {
        public function getTab(): Tab
        {
            return new \Timetabio\Frontend\Tabs\SearchPage\Feeds;
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
