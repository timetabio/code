<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Exceptions
{
    use Timetabio\Framework\Http\StatusCodes\StatusCodeInterface;

    class Unauthorized extends AbstractException
    {
        public function getStatusCode(): StatusCodeInterface
        {
            return new \Timetabio\Framework\Http\StatusCodes\Unauthorized;
        }
    }
}
