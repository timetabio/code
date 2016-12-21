<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\Tasks
{
    use Timetabio\Library\TaskPriorities\Priority;

    class BuildPostTask implements TaskInterface
    {
        /**
         * @var string
         */
        private $postId;

        /**
         * @var Priority
         */
        private $priority;

        public function __construct(string $postId, Priority $priority = null)
        {
            $this->postId = $postId;
            $this->priority = $priority;
        }

        public function getPostId(): string
        {
            return $this->postId;
        }

        public function getPriority(): \Timetabio\Library\TaskPriorities\Priority
        {
            if ($this->priority === null) {
                return new \Timetabio\Library\TaskPriorities\Low;
            }

            return $this->priority;
        }
    }
}
