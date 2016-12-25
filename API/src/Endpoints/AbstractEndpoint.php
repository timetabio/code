<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Endpoints
{
    use Timetabio\Framework\Controllers\ControllerInterface;
    use Timetabio\Framework\Factories\MasterFactoryInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\ValueObjects\Uri;

    abstract class AbstractEndpoint implements EndpointInterface
    {
        /**
         * @var MasterFactoryInterface
         */
        private $factory;

        public function __construct(MasterFactoryInterface $factory)
        {
            $this->factory = $factory;
        }

        public function canHandle(RequestInterface $request): bool
        {
            return $this->validate($request->getUri());
        }

        public function handle(RequestInterface $request): ControllerInterface
        {
            if (get_class($request) !== $this->getRequestType()) {
                throw new \Exception;
            }

            return $this->doHandle($request);
        }

        protected function validate(Uri $uri): bool
        {
            if (strpos($this->getEndpoint(), ':') === false) {
                return $this->getEndpoint() === $uri->getPath();
            }

            $explodedPath = $uri->getExplodedPath();
            $explodedEndpointPath = explode('/', ltrim($this->getEndpoint(), '/'));

            if (count($explodedPath) !== count($explodedEndpointPath)) {
                return false;
            }

            foreach ($explodedEndpointPath as $i => $part) {
                if (strpos($part, ':') !== false) {
                    continue;
                }

                if ($part !== $explodedPath[$i]) {
                    return false;
                }
            }

            return true;
        }

        protected function getFactory(): MasterFactoryInterface
        {
            return $this->factory;
        }

        abstract protected function doHandle(RequestInterface $request): ControllerInterface;
    }
}
