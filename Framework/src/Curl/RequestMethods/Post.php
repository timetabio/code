<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Curl\RequestMethods
{
    class Post implements RequestMethodInterface
    {
        public function __toString(): string
        {
            return 'POST';
        }

        public function hasBody(): bool
        {
            return true;
        }
    }
}
