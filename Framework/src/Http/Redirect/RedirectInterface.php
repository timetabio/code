<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Http\Redirect
{
    use Timetabio\Framework\Http\StatusCodes\StatusCodeInterface;
    use Timetabio\Framework\ValueObjects\Uri;

    interface RedirectInterface
    {
        public function getUri(): Uri;

        public function getStatusCode(): StatusCodeInterface;
    }
}
