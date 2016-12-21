<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\ValueObjects
{
    class Header
    {
        /**
         * @var string
         */
        private $name;

        /**
         * @var string
         */
        private $value;

        public function __construct(string $name, string $value)
        {
            $this->name = strtolower($name);
            $this->value = $value;
        }

        public function getName(): string
        {
            return $this->name;
        }

        public function getValue(): string
        {
            return $this->value;
        }

        public function __toString()
        {
            return $this->name . ': ' . $this->value;
        }
    }
}
