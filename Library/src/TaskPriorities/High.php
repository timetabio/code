<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\TaskPriorities
{
    class High implements Priority
    {
        public function getValue(): int
        {
            return 300;
        }
    }
}
