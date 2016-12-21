<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Curl\RequestMethods
{
    class Patch implements RequestMethodInterface
    {
        public function __toString(): string
        {
            return 'PATCH';
        }

        public function hasBody(): bool
        {
            return true;
        }
    }
}
