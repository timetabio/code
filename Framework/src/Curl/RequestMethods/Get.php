<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Curl\RequestMethods
{
    class Get implements RequestMethodInterface
    {
        public function __toString(): string
        {
            return 'GET';
        }

        public function hasBody(): bool
        {
            return false;
        }
    }
}
