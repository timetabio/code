<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\ValueObjects
{
    class FeedName implements \JsonSerializable
    {
        /**
         * @var string
         */
        private $value;

        public function __construct(string $value)
        {
            $trimmed = trim($value);

            if (empty($value)) {
                throw new \Exception('feed name must not be empty');
            }

            if (strlen($trimmed) > 64) {
                throw new \Exception('feed name limit of 64 b exceeded');
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
