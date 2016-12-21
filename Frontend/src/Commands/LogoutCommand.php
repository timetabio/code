<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Commands
{
    use Timetabio\Frontend\Gateways\ApiGateway;
    use Timetabio\Frontend\Session\Session;

    class LogoutCommand
    {
        /**
         * @var Session
         */
        private $session;

        /**
         * @var ApiGateway
         */
        private $apiGateway;

        public function __construct(Session $session, ApiGateway $apiGateway)
        {
            $this->session = $session;
            $this->apiGateway = $apiGateway;
        }

        public function execute()
        {
            $token = $this->session->getAccessToken();

            $this->session->removeUser();
            $this->session->removeAccessToken();

            $this->apiGateway->revokeToken($token);
        }
    }
}
