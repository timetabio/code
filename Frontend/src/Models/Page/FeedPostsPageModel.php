<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Models\Page
{
    use Timetabio\Frontend\ValueObjects\PaginatedResult;

    class FeedPostsPageModel extends FeedPageModel
    {
        /**
         * @var PaginatedResult
         */
        private $feedPosts;

        public function getFeedPosts(): PaginatedResult
        {
            return $this->feedPosts;
        }

        public function setFeedPosts(PaginatedResult $feedPosts)
        {
            $this->feedPosts = $feedPosts;
        }
    }
}
