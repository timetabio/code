<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\DataObjects
{
    use Timetabio\Framework\Curl\Response;
    use Timetabio\Frontend\Exceptions\ApiException;

    class ApiResponse
    {
        /**
         * @var Response
         */
        private $response;

        public function __construct(Response $response)
        {
            $this->response = $response;
        }

        /**
         * @throws ApiException
         */
        public function unwrap()
        {
            $code = $this->response->getCode();
            $data = $this->response->getJsonDecodedBody();

            if ($code === 404) {
                return null;
            }

            if ($code >= 400 && $code < 600) {
                throw new ApiException($data['error']);
            }

            return $data;
        }
    }
}
