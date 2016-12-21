<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\Tasks
{
    /**
     * @todo: rename -> UpdateUserFeedsTask
     */
    class IndexUserTask implements TaskInterface
    {
        /**
         * @var string
         */
        private $userId;

        public function __construct(string $userId)
        {
            $this->userId = $userId;
        }

        public function getUserId(): string
        {
            return $this->userId;
        }

        public function getPriority(): \Timetabio\Library\TaskPriorities\Priority
        {
            return new \Timetabio\Library\TaskPriorities\Normal;
        }
    }
}
