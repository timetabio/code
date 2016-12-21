<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Controllers
{
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Http\Response\ResponseInterface;

    interface ControllerInterface
    {
        public function processRequest(RequestInterface $request): ResponseInterface;
    }
}
