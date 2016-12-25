<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Endpoints
{
    use Timetabio\API\Access\AccessTypes\AccessTypeInterface;
    use Timetabio\Framework\Controllers\ControllerInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;

    class RevokeEndpoint extends AbstractEndpoint
    {
        public function getEndpoint(): string
        {
            return '/v1/revoke';
        }

        public function getRequestType(): string
        {
            return \Timetabio\Framework\Http\Request\PostRequest::class;
        }

        public function hasAccess(AccessTypeInterface $accessType): bool
        {
            return $accessType instanceof \Timetabio\API\Access\AccessTypes\FullAccess || $accessType instanceof \Timetabio\API\Access\AccessTypes\ScopedAccess;
        }

        protected function doHandle(RequestInterface $request): ControllerInterface
        {
            return $this->getFactory()->createRevokeController();
        }
    }
}
