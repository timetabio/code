<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Map
{
    interface ReadableMapInterface
    {
        public function has(string $key): bool;

        public function get(string $key);
    }
}
