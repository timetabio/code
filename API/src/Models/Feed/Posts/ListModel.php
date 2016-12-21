<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Models\Feed\Posts
{
    use Timetabio\API\ValueObjects\FeedId;

    class ListModel extends \Timetabio\API\Models\ListModel
    {
        /**
         * @var FeedId
         */
        private $feedId;

        public function getFeedId(): FeedId
        {
            return $this->feedId;
        }

        public function setFeedId(FeedId $feedId)
        {
            $this->feedId = $feedId;
        }
    }
}
