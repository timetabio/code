<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Models\Feed\People
{
    class ListModel extends \Timetabio\API\Models\ListModel
    {
        /**
         * @var string
         */
        private $feedId;

        public function getFeedId(): string
        {
            return $this->feedId;
        }

        public function setFeedId(string $feedId)
        {
            $this->feedId = $feedId;
        }
    }
}
