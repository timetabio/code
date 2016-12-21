<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Map
{
    interface WritableMapInterface
    {
        public function set(string $key, $value);

        public function remove(string $key);
    }
}
