<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Endpoints\Feeds
{
    use Timetabio\API\Access\AccessTypes\AccessTypeInterface;
    use Timetabio\API\Access\AccessTypes\FullAccess;
    use Timetabio\API\Access\AccessTypes\ScopedAccess;
    use Timetabio\API\Endpoints\AbstractEndpoint;
    use Timetabio\Framework\Controllers\ControllerInterface;
    use Timetabio\Framework\Http\Request\PostRequest;
    use Timetabio\Framework\Http\Request\RequestInterface;

    class CreateFeedEndpoint extends AbstractEndpoint
    {
        public function getEndpoint(): string
        {
            return '/v1/feeds';
        }

        public function getRequestType(): string
        {
            return PostRequest::class;
        }

        public function hasAccess(AccessTypeInterface $accessType): bool
        {
            if ($accessType instanceof FullAccess) {
                return true;
            }

            if ($accessType instanceof ScopedAccess) {
                return $accessType->hasScope('feeds:write');
            }

            return false;
        }

        protected function doHandle(RequestInterface $request): ControllerInterface
        {
            return $this->getFactory()->createCreateFeedController();
        }
    }
}
