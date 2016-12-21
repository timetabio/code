<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Endpoints\Feeds
{
    use Timetabio\API\Access\AccessTypes\AccessTypeInterface;
    use Timetabio\API\Endpoints\AbstractEndpoint;
    use Timetabio\Framework\Controllers\ControllerInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;

    class GetFeedUsersEndpoint extends AbstractEndpoint
    {
        public function getEndpoint(): string
        {
            return '/v1/feeds/:feed_id/users';
        }

        public function getRequestType(): string
        {
            return \Timetabio\Framework\Http\Request\GetRequest::class;
        }

        public function hasAccess(AccessTypeInterface $accessType): bool
        {
            return true;
        }

        protected function doHandle(RequestInterface $request): ControllerInterface
        {
            return $this->getFactory()->createGetFeedUsersController();
        }
    }
}
