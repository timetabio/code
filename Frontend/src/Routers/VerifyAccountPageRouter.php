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
    use Timetabio\Frontend\Commands\VerifyCommand;
    use Timetabio\Frontend\Exceptions\ApiException;
    use Timetabio\Frontend\Factories\FactoryTypeHint;

    class VerifyAccountPageRouter implements RouterInterface
    {
        /**
         * @var FactoryTypeHint
         */
        private $factory;

        /**
         * @var VerifyCommand
         */
        private $verifyCommand;

        public function __construct(MasterFactoryInterface $factory, VerifyCommand $verifyCommand)
        {
            $this->factory = $factory;
            $this->verifyCommand = $verifyCommand;
        }

        public function route(RequestInterface $request): ControllerInterface
        {
            if ($request->getUri()->getPath() !== '/account/verify') {
                throw new RouterException;
            }

            if (!$request->hasQueryParam('token')) {
                throw new RouterException;
            }

            $token = $request->getQueryParam('token');

            try {
                $this->verifyCommand->execute($token);
            } catch (ApiException $exception) {
                throw new RouterException;
            }

            return $this->factory->createVerifyAccountPageController();
        }

        public function canHandle(RequestInterface $request): bool
        {
            return $request instanceof \Timetabio\Framework\Http\Request\GetRequest;
        }
    }
}
