<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\TabNavItems\FeedPage
{
    use Timetabio\Frontend\TabNavItems\AbstractTabNavItem;
    use Timetabio\Frontend\Tabs\Tab;

    class Settings extends AbstractTabNavItem
    {
        public function getTab(): Tab
        {
            return new \Timetabio\Frontend\Tabs\FeedPage\Settings;
        }

        public function getIcon(): string
        {
            return 'settings';
        }

        public function getLabel(): string
        {
            return 'Settings';
        }
    }
}
