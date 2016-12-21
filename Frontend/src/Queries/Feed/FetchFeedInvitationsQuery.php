<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Queries\Feed
{
    use Timetabio\Frontend\Gateways\ApiGateway;

    class FetchFeedInvitationsQuery
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
            return $this->apiGateway->getFeedInvitations($feedId)->unwrap();
        }
    }
}
