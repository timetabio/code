<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Routers
{
    use Timetabio\Framework\Controllers\ControllerInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;

    interface RouterInterface
    {
        public function route(RequestInterface $request): ControllerInterface;

        public function canHandle(RequestInterface $request): bool;
    }
}
