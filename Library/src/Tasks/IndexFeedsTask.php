<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\Tasks
{
    class IndexFeedsTask implements TaskInterface
    {
        public function getPriority(): \Timetabio\Library\TaskPriorities\Priority
        {
            return new \Timetabio\Library\TaskPriorities\Low;
        }
    }
}
