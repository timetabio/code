<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Queries
{
    use Timetabio\Frontend\Gateways\ApiGateway;
    use Timetabio\Frontend\ValueObjects\PaginatedResult;

    class FetchFeedPostsQuery
    {
        /**
         * @var ApiGateway
         */
        private $apiGateway;

        public function __construct(ApiGateway $apiGateway)
        {
            $this->apiGateway = $apiGateway;
        }

        public function execute(string $feedId, $limit = 20, $page = 1)
        {
            $response = $this->apiGateway->getFeedPosts($feedId, $limit, $page);
            $data = $response->unwrap();

            if ($data === null) {
                return new PaginatedResult([]);
            }

            return new PaginatedResult($data);
        }
    }
}
