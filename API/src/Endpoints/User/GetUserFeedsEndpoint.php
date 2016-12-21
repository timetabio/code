<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Endpoints\User
{
    use Timetabio\API\Access\AccessTypes\AccessTypeInterface;
    use Timetabio\API\Access\AccessTypes\FullAccess;
    use Timetabio\API\Access\AccessTypes\ScopedAccess;
    use Timetabio\API\Endpoints\AbstractEndpoint;
    use Timetabio\Framework\Controllers\ControllerInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;

    class GetUserFeedsEndpoint extends AbstractEndpoint
    {
        protected function doHandle(RequestInterface $request): ControllerInterface
        {
            return $this->getFactory()->createGetUserFeedsController();
        }

        public function getEndpoint(): string
        {
            return '/v1/user/feeds';
        }

        public function getRequestType(): string
        {
            return \Timetabio\Framework\Http\Request\GetRequest::class;
        }

        public function hasAccess(AccessTypeInterface $accessType): bool
        {
            if ($accessType instanceof FullAccess) {
                return true;
            }

            if ($accessType instanceof ScopedAccess) {
                return $accessType->hasScope('feeds:read');
            }

            return false;
        }
    }
}
