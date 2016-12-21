<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\TabNavItems\SearchPage
{
    use Timetabio\Frontend\TabNavItems\AbstractTabNavItem;
    use Timetabio\Frontend\Tabs\Tab;

    class Everything extends AbstractTabNavItem
    {
        public function getTab(): Tab
        {
            return new \Timetabio\Frontend\Tabs\SearchPage\Everything;
        }

        public function getIcon(): string
        {
            return 'search';
        }

        public function getLabel(): string
        {
            return 'Everything';
        }
    }
}
