<?php
namespace Timetabio\Frontend\Commands
{
    use Timetabio\Frontend\Gateways\ApiGateway;

    class ForgotCommand
    {
        /**
         * @var ApiGateway
         */
        private $apiGateway;

        public function __construct(ApiGateway $apiGateway)
        {
            $this->apiGateway = $apiGateway;
        }

        public function execute(string $user)
        {
            return $this->apiGateway->forgot($user)->unwrap();
        }
    }
}
