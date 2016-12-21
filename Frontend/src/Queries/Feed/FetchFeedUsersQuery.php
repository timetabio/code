<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Queries\Feed
{
    use Timetabio\Frontend\Gateways\ApiGateway;

    class FetchFeedUsersQuery
    {
        /**
         * @var ApiGateway
         */
        private $apiGateway;

        public function __construct(ApiGateway $apiGateway)
        {
            $this->apiGateway = $apiGateway;
        }

        public function execute(string $feedId)
        {
            return $this->apiGateway->getFeedUsers($feedId)->unwrap();
        }
    }
}
