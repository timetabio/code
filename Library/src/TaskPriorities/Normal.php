<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\TaskPriorities
{
    class Normal implements Priority
    {
        public function getValue(): int
        {
            return 0;
        }
    }
}
