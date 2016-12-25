<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\Factories
{
    use Timetabio\Framework\Configuration\ConfigurationInterface;

    /**
     * @mixin FrameworkFactory
     * @mixin BackendFactory
     * @mixin LoggerFactory
     */
    interface MasterFactoryInterface
    {
        public function registerFactory(ChildFactoryInterface $factory);

        public function getConfiguration(): ConfigurationInterface;
    }
}
