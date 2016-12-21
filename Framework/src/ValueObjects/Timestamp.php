<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\ValueObjects
{
    class Timestamp
    {
        /**
         * @var int
         */
        private $timestamp;

        public function __construct(int $timestamp)
        {
            $this->timestamp = $timestamp;
        }

        public function getTimestamp(): int
        {
            return $this->timestamp;
        }

        public function __toString(): string
        {
            return gmdate('Y-m-d H:i:s.u', $this->timestamp);
        }
    }
}
