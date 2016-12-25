<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\Backends
{
    use Timetabio\Framework\Curl\Curl;
    use Timetabio\Framework\ValueObjects\Uri;
    use Timetabio\S3Helper\Builders\RequestBuilder;

    class AwsRestBackend
    {
        /**
         * @var RequestBuilder
         */
        private $requestBuilder;

        /**
         * @var Curl
         */
        private $curl;

        public function __construct(RequestBuilder $requestBuilder, Curl $curl)
        {
            $this->requestBuilder = $requestBuilder;
            $this->curl = $curl;
        }

        public function deleteObject(string $objectName)
        {
            $objectUri = new \Timetabio\S3Helper\ValueObjects\Uri('/' . $objectName);
            $request = $this->requestBuilder->buildRequest('DELETE', $objectUri);

            $response = $this->curl->delete(
                new Uri($request->getUrl()),
                null,
                $request->getHeaders()
            );

            $code = $response->getCode();

            if ($code !== 204) {
                throw new \Exception('invalid response code from amazon s3 (' . $code . ')');
            }
        }
    }
}
