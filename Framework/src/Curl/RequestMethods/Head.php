<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Curl\RequestMethods
{
    class Head implements RequestMethodInterface
    {
        public function __toString(): string
        {
            return 'HEAD';
        }

        public function hasBody(): bool
        {
            return false;
        }
    }
}
