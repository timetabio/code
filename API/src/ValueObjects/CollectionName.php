<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\ValueObjects
{
    class CollectionName
    {
        /**
         * @var string
         */
        private $name;

        public function __construct(string $name)
        {
            $name = trim($name);
            $length = mb_strlen($name);

            // TODO: 40 characters?
            if ($length <= 1 || $length >= 40) {
                throw new \Exception('collection name must be between 1 and 40 characters long');
            }

            // TODO: Maybe regex check?

            $this->name = $name;
        }

        public function __toString(): string
        {
            return $this->name;
        }
    }
}
