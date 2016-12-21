<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\ValueObjects
{
    class PostBody
    {
        /**
         * @var string
         */
        private $value;

        public function __construct(string $value)
        {
            // 8 KiB = 8192 B
            if (strlen($value) > 8192) {
                throw new \Exception('post max size exceeded');
            }

            $this->value = $value;
        }

        public function __toString(): string
        {
            return $this->value;
        }
    }
}
