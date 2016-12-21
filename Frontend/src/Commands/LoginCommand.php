<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Commands
{
    use Timetabio\Frontend\DataObjects\User;
    use Timetabio\Frontend\Gateways\ApiGateway;
    use Timetabio\Frontend\Session\Session;

    class LoginCommand
    {
        /**
         * @var ApiGateway
         */
        private $apiGateway;

        /**
         * @var Session
         */
        private $session;

        public function __construct(ApiGateway $apiGateway, Session $session)
        {
            $this->apiGateway = $apiGateway;
            $this->session = $session;
        }

        public function execute(string $user, string $password)
        {
            $response = $this->apiGateway->authenticate($user, $password);
            $authData = $response->unwrap();

            $this->session->setAccessToken($authData['access_token']);

            $userInfo = $this->apiGateway->getUser()->unwrap();

            $this->session->setUser(new User(
                $userInfo['id'],
                $userInfo['username'],
                $userInfo['name']
            ));
        }
    }
}
