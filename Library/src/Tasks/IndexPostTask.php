<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\Tasks
{
    class IndexPostTask implements TaskInterface
    {
        /**
         * @var string
         */
        private $postId;

        public function __construct($postId)
        {
            $this->postId = $postId;
        }

        public function getPostId(): string
        {
            return $this->postId;
        }

        public function getPriority(): \Timetabio\Library\TaskPriorities\Priority
        {
            return new \Timetabio\Library\TaskPriorities\Normal;
        }
    }
}
