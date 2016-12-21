<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
