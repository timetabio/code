<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Pdo\Value
{
    class NullValue implements ValueInterface
    {
        public function getType(): int
        {
            return \PDO::PARAM_NULL;
        }

        public function getValue()
        {
            return null;
        }
    }
}
