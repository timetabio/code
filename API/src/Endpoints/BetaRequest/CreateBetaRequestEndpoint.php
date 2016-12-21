<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Endpoints\BetaRequest
{
    use Timetabio\API\Access\AccessTypes\AccessTypeInterface;
    use Timetabio\API\Endpoints\AbstractEndpoint;
    use Timetabio\Framework\Controllers\ControllerInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;

    class CreateBetaRequestEndpoint extends AbstractEndpoint
    {
        protected function doHandle(RequestInterface $request): ControllerInterface
        {
            return $this->getFactory()->createCreateBetaRequestController();
        }

        public function getEndpoint(): string
        {
            return '/v1/beta_requests';
        }

        public function getRequestType(): string
        {
            return \Timetabio\Framework\Http\Request\PostRequest::class;
        }

        public function hasAccess(AccessTypeInterface $accessType): bool
        {
            return $accessType instanceof \Timetabio\API\Access\AccessTypes\SystemAccess;
        }
    }
}
