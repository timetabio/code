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

    abstract class FeedPageModel extends PageModel
    {
        /**
         * @var Feed
         */
        private $feed;

        public function __construct(Feed $feed)
        {
            $this->feed = $feed;
        }

        public function getFeed(): Feed
        {
            return $this->feed;
        }

        public function getTitle(): string
        {
            return $this->feed->getName();
        }

        abstract public function getActiveTab(): Tab;
    }
}
