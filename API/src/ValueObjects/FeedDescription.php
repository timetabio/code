<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\ValueObjects
{
    class FeedDescription implements \JsonSerializable
    {
        /**
         * @var string
         */
        private $value;

        public function __construct(string $value = '')
        {
            $trimmed = trim($value);

            if (strlen($trimmed) > 140) {
                throw new \Exception('feed description limit of 140 b exceeded');
            }

            $this->value = $trimmed;
        }

        public function __toString(): string
        {
            return $this->value;
        }

        public function jsonSerialize(): string
        {
            return $this->value;
        }
    }
}
