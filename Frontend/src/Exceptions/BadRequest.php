<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Exceptions
{
    use Timetabio\Framework\Http\StatusCodes\StatusCodeInterface;

    class BadRequest extends AbstractException
    {
        public function getStatusCode(): StatusCodeInterface
        {
            return new \Timetabio\Framework\Http\StatusCodes\BadRequest;
        }
    }
}
