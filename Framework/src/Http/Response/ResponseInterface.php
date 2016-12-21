<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Http\Response
{
    use Timetabio\Framework\Http\Redirect\RedirectInterface;
    use Timetabio\Framework\Http\StatusCodes\StatusCodeInterface;
    use Timetabio\Framework\ValueObjects\Cookie;
    use Timetabio\Framework\ValueObjects\Header;

    interface ResponseInterface
    {
        public function setStatusCode(StatusCodeInterface $statusCode);

        public function setHeader(Header $header);

        public function setCookie(Cookie $cookie);

        public function setRedirect(RedirectInterface $redirect);

        public function setBody(string $body);

        public function send();
    }
}
