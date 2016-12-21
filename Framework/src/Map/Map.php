<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Map
{
    class Map implements MapInterface, \IteratorAggregate
    {
        /**
         * @var array
         */
        private $data;

        public function __construct(array $data = [])
        {
            $this->data = $data;
        }

        public function has(string $key): bool
        {
            return isset($this->data[$key]);
        }

        public function get(string $key)
        {
            if (!isset($this->data[$key])) {
                throw new \Exception('key "' . $key . '" not found in map');
            }

            return $this->data[$key];
        }

        public function set(string $key, $value)
        {
            $this->data[$key] = $value;
        }

        public function remove(string $key)
        {
            unset($this->data[$key]);
        }

        public function getIterator()
        {
            return new \ArrayIterator($this->data);
        }
    }
}
