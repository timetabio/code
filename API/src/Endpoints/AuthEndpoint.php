<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Endpoints
{
    use Timetabio\API\Access\AccessTypes\AccessTypeInterface;
    use Timetabio\Framework\Controllers\ControllerInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;

    class AuthEndpoint extends AbstractEndpoint
    {
        public function getEndpoint(): string
        {
            return '/v1/auth';
        }

        public function getRequestType(): string
        {
            return \Timetabio\Framework\Http\Request\PostRequest::class;
        }

        public function hasAccess(AccessTypeInterface $accessType): bool
        {
            return true;
        }

        protected function doHandle(RequestInterface $request): ControllerInterface
        {
            return $this->getFactory()->createAuthController();
        }
    }
}
