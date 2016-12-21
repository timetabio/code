<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\ValueObjects
{
    class PostTitle
    {
        /**
         * @var string
         */
        private $value;

        public function __construct(string $value)
        {
            $trimmed = trim($value);

            if (empty($value)) {
                throw new \Exception('post title must not be empty');
            }

            if (strlen($trimmed) > 64) {
                throw new \Exception('post title limit of 64 b exceeded');
            }

            $this->value = $trimmed;
        }

        public function __toString(): string
        {
            return $this->value;
        }
    }
}
