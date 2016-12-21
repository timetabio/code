<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Commands
{
    use Timetabio\Frontend\Gateways\ApiGateway;

    class RegisterCommand
    {
        /**
         * @var ApiGateway
         */
         private $apiGateway;

         public function __construct(ApiGateway $apiGateway)
         {
            $this->apiGateway = $apiGateway;
         }

         public function execute(string $email, string $username, string $password)
         {
             $user = $this->apiGateway->createUser($email, $username, $password)->unwrap();

             if ($user === null) {
                 throw new \RuntimeException('invalid api response');
             }

             return $user;
         }
    }
}
