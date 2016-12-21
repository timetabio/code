<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\ValueObjects
{
    class StringBoolean
    {
        /**
         * @var bool
         */
        private $value;

        public function __construct(string $value)
        {
            $this->value = $this->parseValue($value);
        }

        private function parseValue(string $value): bool
        {
            switch ($value) {
                case 'true':
                    return true;
                case 'false':
                    return false;
            }

            throw new \Exception('invalid value');
        }

        public function getValue(): bool
        {
            return $this->value;
        }
    }
}
