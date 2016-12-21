<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Models\Feed
{
    use Timetabio\API\Models\UpdateModelTrait;

    class UpdateModel extends FeedModel
    {
        use UpdateModelTrait;

        /**
         * @var string
         */
        private $feedVanity;

        public function hasFeedVanity(): bool
        {
            return $this->feedVanity !== null;
        }

        public function getFeedVanity(): string
        {
            return $this->feedVanity;
        }

        public function setFeedVanity(string $feedVanity)
        {
            $this->feedVanity = $feedVanity;
        }
    }
}
