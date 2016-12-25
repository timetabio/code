<?php
// @codeCoverageIgnoreStart
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\Curl
{
    use Timetabio\Framework\Curl\Credentials\CredentialsInterface;
    use Timetabio\Framework\Curl\RequestMethods\Head;
    use Timetabio\Framework\Curl\RequestMethods\RequestMethodInterface;
    use Timetabio\Framework\ValueObjects\Uri;

    class CurlHandler
    {
        /**
         * @var resource
         */
        private $handle;

        /**
         * @var RequestHeaders
         */
        private $headers;

        public function executeRequest(
            Uri $url,
            RequestMethodInterface $requestMethod,
            array $params = [],
            CredentialsInterface $credentials = null,
            array $headers = []
        ): Response
        {
            $this->handle = curl_init();
            $this->headers = new RequestHeaders;

            foreach ($headers as $key => $value) {
                $this->headers->set($key, $value);
            }

            $this->enableReturnTransfer();
            $this->setUrl($url);
            $this->setRequestMethod($requestMethod);

            if ($credentials instanceof CredentialsInterface) {
                $this->setCredentials($credentials);
            }

            if ($requestMethod->hasBody()) {
                $this->setPostFields($params);
            }

            $this->setHeaders();

            $body = curl_exec($this->handle);
            $code = curl_getinfo($this->handle, CURLINFO_HTTP_CODE);
            $error = curl_error($this->handle);

            if (!empty($error)) {
                throw new \RuntimeException($error, curl_errno($this->handle));
            }

            curl_close($this->handle);

            return new Response($code, $body);
        }

        private function setUrl(string $url)
        {
            $this->setOption(CURLOPT_URL, $url);
        }

        private function enableReturnTransfer()
        {
            $this->setOption(CURLOPT_RETURNTRANSFER, true);
        }

        private function setCredentials(CredentialsInterface $credentials)
        {
            $this->headers->set('authorization', (string) $credentials);
        }

        private function setHeaders()
        {
            $this->setOption(CURLOPT_HTTPHEADER, $this->headers->toArray());
        }

        private function setPostFields(array $params)
        {
            $this->setOption(CURLOPT_POST, true);
            $this->setOption(CURLOPT_POSTFIELDS, http_build_query($params));
        }

        private function setRequestMethod(RequestMethodInterface $requestMethod)
        {
            $this->setOption(CURLOPT_CUSTOMREQUEST, (string) $requestMethod);

            if ($requestMethod instanceof Head) {
                $this->setOption(CURLOPT_NOBODY, true);
            }
        }

        private function setOption(int $opt, $value)
        {
            curl_setopt($this->handle, $opt, $value);
        }
    }
}
// @codeCoverageIgnoreEnd
