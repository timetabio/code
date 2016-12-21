<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
