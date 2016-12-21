<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Endpoints
{
    use Timetabio\API\Access\AccessTypes\AccessTypeInterface;
    use Timetabio\Framework\Controllers\ControllerInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;

    interface EndpointInterface
    {
        public function getEndpoint(): string;

        public function getRequestType(): string;

        public function hasAccess(AccessTypeInterface $accessType): bool;

        public function canHandle(RequestInterface $request): bool;

        public function handle(RequestInterface $request): ControllerInterface;
    }
}
