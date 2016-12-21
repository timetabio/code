<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\TaskPriorities
{
    class Random implements Priority
    {
        /**
         * @var int
         */
        private $value;

        public function __construct(int $max)
        {
            $this->value = -random_int(0, $max);
        }

        public function getValue(): int
        {
            return $this->value;
        }
    }
}
