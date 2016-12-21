<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Worker\Locators
{
    use Timetabio\Framework\Http\StatusCodes\StatusCodeInterface;

    class StatusCodeLocator
    {
        public function locate(int $statusCode): StatusCodeInterface
        {
            switch ($statusCode) {
                case 404:
                    return new \Timetabio\Framework\Http\StatusCodes\NotFound;
                case 500:
                    return new \Timetabio\Framework\Http\StatusCodes\InternalServerError;
            }

            throw new \Exception('status code ' . $statusCode . ' not found');
        }
    }
}
