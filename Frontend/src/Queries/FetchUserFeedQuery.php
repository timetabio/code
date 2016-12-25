<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Queries
{
    use Timetabio\Frontend\Gateways\ApiGateway;
    use Timetabio\Frontend\ValueObjects\PaginatedResult;

    class FetchUserFeedQuery
    {
        /**
         * @var ApiGateway
         */
        private $apiGateway;

        public function __construct(ApiGateway $apiGateway)
        {
            $this->apiGateway = $apiGateway;
        }

        public function execute(int $limit = 20, int $page = 1): PaginatedResult
        {
            $response = $this->apiGateway->getUserFeed($limit, $page);
            $data = $response->unwrap();

            return new PaginatedResult($data);
        }
    }
}
