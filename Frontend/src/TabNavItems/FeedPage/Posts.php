<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\TabNavItems\FeedPage
{
    use Timetabio\Frontend\TabNavItems\AbstractTabNavItem;
    use Timetabio\Frontend\Tabs\Tab;

    class Posts extends AbstractTabNavItem
    {
        public function getTab(): Tab
        {
            return new \Timetabio\Frontend\Tabs\FeedPage\Posts;
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
