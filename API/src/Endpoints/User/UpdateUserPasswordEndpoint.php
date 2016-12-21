<?php
namespace Timetabio\API\Endpoints\User
{
    use Timetabio\API\Access\AccessTypes\AccessTypeInterface;
    use Timetabio\API\Access\AccessTypes\FullAccess;
    use Timetabio\API\Access\AccessTypes\ScopedAccess;
    use Timetabio\API\Endpoints\AbstractEndpoint;
    use Timetabio\Framework\Controllers\ControllerInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;

    class UpdateUserPasswordEndpoint extends AbstractEndpoint
    {
        public function getEndpoint(): string
        {
            return '/v1/user/password';
        }

        public function getRequestType(): string
        {
            return \Timetabio\Framework\Http\Request\PutRequest::class;
        }

        public function hasAccess(AccessTypeInterface $accessType): bool
        {
            if ($accessType instanceof FullAccess) {
                return true;
            }

            if ($accessType instanceof ScopedAccess) {
                return $accessType->hasScope('user:write');
            }

            return false;
        }

        protected function doHandle(RequestInterface $request): ControllerInterface
        {
            return $this->getFactory()->createUpdateUserPasswordController();
        }
    }
}
