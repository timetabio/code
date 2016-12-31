<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Factories
{
    use Timetabio\Framework\Factories\MasterFactory;

    /**
     * @mixin ApplicationFactory
     * @mixin BackendFactory
     * @mixin CommandFactory
     * @mixin ControllerFactory
     * @mixin ErrorHandlerFactory
     * @mixin EndpointFactory
     * @mixin HandlerFactory
     * @mixin MapperFactory
     * @mixin QueryFactory
     * @mixin RouterFactory
     * @mixin ServiceFactory
     * @mixin \Timetabio\Framework\Factories\FrameworkFactory
     * @mixin \Timetabio\Framework\Factories\BackendFactory
     * @mixin \Timetabio\Framework\Factories\LoggerFactory
     * @mixin \Timetabio\Library\Factories\ApplicationFactory
     * @mixin \Timetabio\Library\Factories\IndexerFactory
     * @mixin \Timetabio\Library\Factories\LocatorFactory
     * @mixin \Timetabio\Library\Factories\MapperFactory
     * @mixin \Timetabio\Library\Factories\ServiceFactory
     */
    class FactoryTypeHint extends MasterFactory
    {

    }
}
