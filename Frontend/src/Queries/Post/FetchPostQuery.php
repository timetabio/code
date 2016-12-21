<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Queries\Post
{
    use Timetabio\Frontend\Gateways\ApiGateway;

    class FetchPostQuery
    {
        /**
         * @var ApiGateway
         */
        private $apiGateway;

        public function __construct(ApiGateway $apiGateway)
        {
            $this->apiGateway = $apiGateway;
        }

        public function execute(string $postId)
        {
            return $this->apiGateway->getPost($postId)->unwrap();
        }
    }
}
