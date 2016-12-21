<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Exceptions
{
    use Timetabio\Framework\Http\StatusCodes\StatusCodeInterface;

    abstract class AbstractException extends \Exception
    {
        abstract public function getStatusCode(): StatusCodeInterface;
    }
}
