<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\TaskPriorities
{
    interface Priority
    {
        public function getValue(): int;
    }
}
