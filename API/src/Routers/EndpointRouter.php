<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Routers
{
    use Timetabio\API\Access\AccessControl;
    use Timetabio\API\Endpoints\EndpointInterface;
    use Timetabio\API\Exceptions\Forbidden;
    use Timetabio\API\Exceptions\MethodNotAllowed;
    use Timetabio\API\Exceptions\NotFound;
    use Timetabio\Framework\Controllers\ControllerInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Routers\RouterInterface;

    class EndpointRouter implements RouterInterface
    {
        /**
         * @var array
         */
        private $endpoints = [];

        /**
         * @var AccessControl
         */
        private $accessControl;

        public function __construct(AccessControl $accessControl)
        {
            $this->accessControl = $accessControl;
        }

        public function registerEndpoint(EndpointInterface $endpoint)
        {
            $this->endpoints[$endpoint->getRequestType()][] = $endpoint;
        }

        public function route(RequestInterface $request): ControllerInterface
        {
            $type = get_class($request);

            if (!isset($this->endpoints[$type])) {
                throw new MethodNotAllowed('method not allowed', 'method_not_allowed');
            }

            /** @var EndpointInterface $endpoint */
            foreach ($this->endpoints[$type] as $endpoint) {
                if (!$endpoint->canHandle($request)) {
                    continue;
                }

                if (!$this->accessControl->hasAccess($request, $endpoint)) {
                    throw new Forbidden('access denied', 'access_denied');
                }

                return $endpoint->handle($request);
            }

            throw new NotFound('No route found for ' . $request->getUri()->getPath(), 'not_found');
        }

        public function canHandle(RequestInterface $request): bool
        {
            return true;
        }
    }
}
