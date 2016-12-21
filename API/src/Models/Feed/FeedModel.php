<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Models\Feed
{
    use Timetabio\API\Models\APIModel;
    use Timetabio\API\ValueObjects\FeedId;

    class FeedModel extends APIModel
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
