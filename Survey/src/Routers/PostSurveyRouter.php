<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Survey\Routers
{
    use Timetabio\Framework\Controllers\ControllerInterface;
    use Timetabio\Framework\Exceptions\RouterException;
    use Timetabio\Framework\Factories\MasterFactoryInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Routers\RouterInterface;
    use Timetabio\Survey\Queries\FetchBetaRequestQuery;

    class PostSurveyRouter implements RouterInterface
    {
        /**
         * @var MasterFactoryInterface
         */
        private $factory;

        /**
         * @var FetchBetaRequestQuery
         */
        private $fetchBetaRequestQuery;

        public function __construct(MasterFactoryInterface $factory, FetchBetaRequestQuery $fetchBetaRequestQuery)
        {
            $this->factory = $factory;
            $this->fetchBetaRequestQuery = $fetchBetaRequestQuery;
        }

        public function route(RequestInterface $request): ControllerInterface
        {
           $parts = $request->getUri()->getPathSegments();

           if ($parts[0] !== 'post' || count($parts) !== 2) {
               throw new RouterException;
           }

           $betaRequest = $this->fetchBetaRequestQuery->execute($parts[1]);

           if ($betaRequest === null) {
               throw new RouterException;
           }

           return $this->factory->createSurveyPageController($betaRequest, 'post');
        }

        public function canHandle(RequestInterface $request): bool
        {
            return $request instanceof \Timetabio\Framework\Http\Request\GetRequest;
        }
    }
}
