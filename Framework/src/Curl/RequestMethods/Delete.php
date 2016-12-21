<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Curl\RequestMethods
{
    class Delete implements RequestMethodInterface
    {
        public function __toString(): string
        {
            return 'DELETE';
        }

        public function hasBody(): bool
        {
            return false;
        }
    }
}
