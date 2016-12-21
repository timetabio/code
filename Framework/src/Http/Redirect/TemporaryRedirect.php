<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Http\Redirect
{
    use Timetabio\Framework\Http\StatusCodes\SeeOther;
    use Timetabio\Framework\Http\StatusCodes\StatusCodeInterface;

    class TemporaryRedirect extends AbstractRedirect
    {
        public function getStatusCode(): StatusCodeInterface
        {
            return new SeeOther();
        }
    }
}
