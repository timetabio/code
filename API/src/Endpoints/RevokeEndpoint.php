<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
