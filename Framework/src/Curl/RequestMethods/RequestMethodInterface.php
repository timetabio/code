<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Curl\RequestMethods
{
    interface RequestMethodInterface
    {
        public function __toString(): string;

        public function hasBody(): bool;
    }
}
