<?php
namespace Timetabio\Frontend\Commands
{
    use Timetabio\Frontend\Gateways\ApiGateway;

    class ResetCommand
    {
        /**
         * @var ApiGateway
         */
        private $apiGateway;

        public function __construct(ApiGateway $apiGateway)
        {
            $this->apiGateway = $apiGateway;
        }

        public function execute(string $token, string $password)
        {
            return $this->apiGateway->reset($token, $password)->unwrap();
        }
    }
}
