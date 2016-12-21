<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Readers
{
    use Timetabio\Framework\Http\Request\RequestInterface;

    class RequestTokenReader
    {
        public function read(RequestInterface $request)
        {
            if (!$request->hasAuthorization()) {
                return null;
            }

            return $request->getAuthorization()->getBearerToken();
        }
    }
}
