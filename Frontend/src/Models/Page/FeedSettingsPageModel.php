<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Models\Page
{
    use Timetabio\Frontend\Tabs\Tab;

    class FeedSettingsPageModel extends FeedPageModel
    {
        public function getActiveTab(): Tab
        {
            return new \Timetabio\Frontend\Tabs\FeedPage\Settings;
        }
    }
}
