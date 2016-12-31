<?php
/**
 * Copyright (c) 2016 Manuel Lopez <manuel.lopez@stud.bbbaden.ch>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Endpoints
{
    use Timetabio\API\Access\AccessTypes\AccessTypeInterface;
    use Timetabio\API\Access\AccessTypes\SystemAccess;
    use Timetabio\Framework\Controllers\ControllerInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;

    class ForgotPasswordEndpoint extends AbstractEndpoint
    {
        public function getEndpoint(): string
        {
            return '/v1/forgot';
        }

        public function getRequestType(): string
        {
            return \Timetabio\Framework\Http\Request\PostRequest::class;
        }

        public function hasAccess(AccessTypeInterface $accessType): bool
        {
            if ($accessType instanceof SystemAccess) {
                return true;
            }

            return false;
        }

        protected function doHandle(RequestInterface $request): ControllerInterface
        {
            return $this->getFactory()->createForgotPasswordController();
        }
    }
}
