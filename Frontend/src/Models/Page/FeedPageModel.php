<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Models\Page
{
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Frontend\Tabs\FeedPage\FeedPageTab;
    use Timetabio\Frontend\Tabs\Tab;
    use Timetabio\Frontend\ValueObjects\Feed;

    class FeedPageModel extends PageModel
    {
        /**
         * @var Feed
         */
        private $feed;

        /**
         * @var Tab
         */
        private $activeTab;

        public function __construct(Feed $feed, Tab $activeTab)
        {
            $this->feed = $feed;
            $this->activeTab = $activeTab;
        }

        public function getFeed(): Feed
        {
            return $this->feed;
        }

        public function getActiveTab(): Tab
        {
            return $this->activeTab;
        }
    }
}
