<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Models
{
    use Timetabio\Frontend\ValueObjects\PaginatedResult;

    class FeedsPageModel extends PageModel
    {
        /**
         * @var PaginatedResult
         */
        private $feeds;

        public function getFeeds(): PaginatedResult
        {
            return $this->feeds;
        }

        public function setFeeds(PaginatedResult $feeds)
        {
            $this->feeds = $feeds;
        }
    }
}
