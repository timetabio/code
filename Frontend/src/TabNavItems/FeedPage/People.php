<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\TabNavItems\FeedPage
{
    use Timetabio\Frontend\TabNavItems\AbstractTabNavItem;
    use Timetabio\Frontend\Tabs\Tab;

    class People extends AbstractTabNavItem
    {
        public function getTab(): Tab
        {
            return new \Timetabio\Frontend\Tabs\FeedPage\People;
        }

        public function getIcon(): string
        {
            return 'person';
        }

        public function getLabel(): string
        {
            return 'People';
        }
    }
}
