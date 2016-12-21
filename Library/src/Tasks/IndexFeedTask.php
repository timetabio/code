<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\Tasks
{
    class IndexFeedTask implements TaskInterface
    {
        /**
         * @var string
         */
        private $feedId;

        public function __construct(string $feedId)
        {
            $this->feedId = $feedId;
        }

        public function getFeedId(): string
        {
            return $this->feedId;
        }

        public function getPriority(): \Timetabio\Library\TaskPriorities\Priority
        {
            return new \Timetabio\Library\TaskPriorities\Normal;
        }
    }
}
