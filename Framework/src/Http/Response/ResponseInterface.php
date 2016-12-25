<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
