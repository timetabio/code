<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Commands\Feed
{
    use Timetabio\Frontend\Gateways\ApiGateway;

    class UnfollowFeedCommand
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
             return $this->apiGateway->unfollowFeed($feedId)->unwrap();
         }
    }
}
