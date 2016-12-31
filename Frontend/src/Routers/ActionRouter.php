<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Routers
{
    use Timetabio\Framework\Controllers\ControllerInterface;
    use Timetabio\Framework\Exceptions\RouterException;
    use Timetabio\Framework\Factories\MasterFactoryInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Routers\RouterInterface;
    use Timetabio\Frontend\Factories\FactoryTypeHint;

    class ActionRouter implements RouterInterface
    {
        /**
         * @var FactoryTypeHint
         */
        private $factory;

        public function __construct(MasterFactoryInterface $factory)
        {
            $this->factory = $factory;
        }

        public function route(RequestInterface $request): ControllerInterface
        {
            switch ($request->getUri()->getPath()) {
                case '/action/register':
                    return $this->factory->createRegisterController();
                case '/action/login':
                    return $this->factory->createLoginController();
                case '/action/resend-verification':
                    return $this->factory->createResendVerificationController();
                case '/action/beta-request':
                    return $this->factory->createCreateBetaRequestController();
                case '/action/begin-reset':
                    return $this->factory->createBeginResetController();
                case '/action/reset':
                    return $this->factory->createResetController();
            }

            throw new RouterException;
        }

        public function canHandle(RequestInterface $request): bool
        {
            return $request instanceof \Timetabio\Framework\Http\Request\PostRequest;
        }
    }
}
