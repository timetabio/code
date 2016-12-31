<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
            $authData = $this->apiGateway->authenticate($user, $password)->unwrap();

            $this->session->setAccessToken($authData['access_token']);

            $userInfo = $this->apiGateway->getUser()->unwrap();

            $this->session->setUser(new User(
                $userInfo['id'],
                $userInfo['username'],
                $userInfo['name']
            ));

            $this->session->renewSessionId();
        }
    }
}
