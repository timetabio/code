<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Commands
{
    use Timetabio\Frontend\Gateways\ApiGateway;

    class VerifyCommand
    {
        /**
         * @var ApiGateway
         */
         private $apiGateway;

         public function __construct(ApiGateway $apiGateway)
         {
            $this->apiGateway = $apiGateway;
         }

         public function execute(string $token)
         {
             return $this->apiGateway->verifyUser($token)->unwrap();
         }
    }
}
