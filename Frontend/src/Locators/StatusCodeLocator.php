<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Locators
{
    use Timetabio\Framework\Http\StatusCodes\StatusCodeInterface;

    class StatusCodeLocator
    {
        public function locate(int $statusCode): StatusCodeInterface
        {
            switch ($statusCode) {
                case 404:
                    return new \Timetabio\Framework\Http\StatusCodes\NotFound;
                case 500:
                    return new \Timetabio\Framework\Http\StatusCodes\InternalServerError;
            }

            throw new \Exception('status code ' . $statusCode . ' not found');
        }
    }
}
