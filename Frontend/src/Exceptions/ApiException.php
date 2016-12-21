<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Exceptions
{
    class ApiException extends \RuntimeException
    {
        public function __toString(): string
        {
            return $this->getMessage();
        }
    }
}
