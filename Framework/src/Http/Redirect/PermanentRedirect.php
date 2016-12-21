<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Http\Redirect
{
    use Timetabio\Framework\Http\StatusCodes\MovedPermanently;
    use Timetabio\Framework\Http\StatusCodes\StatusCodeInterface;

    class PermanentRedirect extends AbstractRedirect
    {
        public function getStatusCode(): StatusCodeInterface
        {
            return new MovedPermanently();
        }
    }
}
