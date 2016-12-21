<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Survey\ValueObjects
{
    class AnswerValue
    {
        /**
         * @var int
         */
        private $value;

        public function __construct(int $value)
        {
            if ($value > 2 || $value < -2) {
                throw new \Exception('invalid answer value');
            }

            $this->value = $value;
        }

        public function getValue(): int
        {
            return $this->value;
        }
    }
}
