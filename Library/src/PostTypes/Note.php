<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\PostTypes
{
    class Note implements PostTypeInterface
    {
        public function __toString(): string
        {
            return 'note';
        }
    }
}
