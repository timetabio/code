<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\ValueObjects
{
    class StringDateTime
    {
        /**
         * @var int
         */
        private $timestamp;

        public function __construct(string $time)
        {
            $this->timestamp = (new \DateTime($time, new \DateTimeZone('UTC')))->getTimestamp();
        }

        public function getTimestamp(): int
        {
            return $this->timestamp;
        }
    }
}
