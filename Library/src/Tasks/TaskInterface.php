<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\Tasks
{
    interface TaskInterface
    {
        public function getPriority(): \Timetabio\Library\TaskPriorities\Priority;
    }
}
