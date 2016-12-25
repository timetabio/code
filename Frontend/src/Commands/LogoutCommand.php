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
