<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Pdo\Value
{
    interface ValueInterface
    {
        public function getType(): int;

        public function getValue();
    }
}
