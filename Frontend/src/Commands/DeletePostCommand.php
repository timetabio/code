<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Commands
{
    use Timetabio\Frontend\Gateways\ApiGateway;

    class DeletePostCommand
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
            return $this->apiGateway->deletePost($postId)->unwrap();
        }
    }
}
