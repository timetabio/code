<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Pdo\Value
{
    class Boolean implements ValueInterface
    {
        /**
         * @var bool
         */
        private $value;

        public function __construct(bool $value)
        {
            $this->value = $value;
        }

        public function getType(): int
        {
            return \PDO::PARAM_BOOL;
        }

        public function getValue(): bool
        {
            return $this->value;
        }
    }
}
