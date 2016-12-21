<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Endpoints\Users
{
    use Timetabio\API\Access\AccessTypes\AccessTypeInterface;
    use Timetabio\API\Access\AccessTypes\SystemAccess;
    use Timetabio\API\Endpoints\AbstractEndpoint;
    use Timetabio\Framework\Controllers\ControllerInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;

    class CreateUserEndpoint extends AbstractEndpoint
    {
        public function getEndpoint(): string
        {
            return '/v1/users';
        }

        public function getRequestType(): string
        {
            return \Timetabio\Framework\Http\Request\PostRequest::class;
        }

        public function hasAccess(AccessTypeInterface $accessType): bool
        {
            return $accessType instanceof SystemAccess;
        }

        protected function doHandle(RequestInterface $request): ControllerInterface
        {
            return $this->getFactory()->createCreateUserController();
        }
    }
}
