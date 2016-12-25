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

    abstract class AbstractResponse implements ResponseInterface
    {
        /**
         * @var string
         */
        private $body;

        /**
         * @var StatusCodeInterface
         */
        private $statusCode;

        /**
         * @var Header[]
         */
        private $headers = [];

        /**
         * @var Cookie[]
         */
        private $cookies = [];

        /**
         * @var RedirectInterface
         */
        private $redirect;

        public function setStatusCode(StatusCodeInterface $statusCode)
        {
            $this->statusCode = $statusCode;
        }

        public function setHeader(Header $header)
        {
            $this->headers[$header->getName()] = $header;
        }

        public function setRedirect(RedirectInterface $redirect)
        {
            $this->redirect = $redirect;
        }

        public function setCookie(Cookie $cookie)
        {
            $this->cookies[$cookie->getName()] = $cookie;
        }

        public function setBody(string $body)
        {
            $this->body = $body;
        }

        public function send()
        {
            $this->setHeader(new Header('content-type', $this->getContentType()));

            foreach ($this->headers as $header) {
                header((string) $header);
            }

            foreach ($this->cookies as $cookie) {
                setcookie(
                    $cookie->getName(),
                    $cookie->getValue(),
                    $cookie->getExpires(),
                    $cookie->getPath(),
                    $cookie->getDomain(),
                    $cookie->isSecure(),
                    $cookie->isHttpOnly()
                );
            }

            if ($this->statusCode instanceof StatusCodeInterface) {
                http_response_code($this->statusCode->getCode());
            }

            if ($this->redirect instanceof RedirectInterface) {
                header(
                    'location: ' . $this->redirect->getUri(),
                    true,
                    $this->redirect->getStatusCode()->getCode()
                );
            }

            echo $this->body;
        }

        abstract protected function getContentType(): string;
    }
}
