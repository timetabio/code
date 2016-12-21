<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Queries
{
    use Timetabio\Frontend\Gateways\ApiGateway;

    class FetchFeedQuery
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
            return $this->apiGateway->getFeed($feedId)->unwrap();
        }
    }
}
