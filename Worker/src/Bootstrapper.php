<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Worker
{
    use Timetabio\Framework\Configuration\Configuration;
    use Timetabio\Framework\Configuration\ConfigurationInterface;
    use Timetabio\Framework\Factories\MasterFactory;
    use Timetabio\Framework\Factories\MasterFactoryInterface;
    use Timetabio\Framework\Translation\Gettext;
    use Timetabio\Library\Backends\Streams\DataStreamWrapper;
    use Timetabio\Library\Backends\Streams\TemplatesStreamWrapper;

    class Bootstrapper
    {
        /**
         * @var ConfigurationInterface
         */
        private $configuration;

        /**
         * @var MasterFactoryInterface
         */
        private $factory;

        public function __construct()
        {
            $this->configuration = $this->buildConfiguration();
            $this->factory = $this->buildFactory();

            DataStreamWrapper::setUp(__DIR__ . '/../data');
            TemplatesStreamWrapper::setUp(__DIR__ . '/../data/templates');

            (new Gettext())->setUp('messages', __DIR__ . '/../../Locale');
        }

        public function getFactory(): MasterFactoryInterface
        {
            return $this->factory;
        }

        private function buildConfiguration(): ConfigurationInterface
        {
            return new Configuration(__DIR__ . '/../config/system.ini');
        }

        private function buildFactory(): MasterFactoryInterface
        {
            $factory = new MasterFactory($this->configuration);

            $factory->registerFactory(new \Timetabio\Framework\Factories\FrameworkFactory);
            $factory->registerFactory(new \Timetabio\Framework\Factories\BackendFactory);
            $factory->registerFactory(new \Timetabio\Framework\Factories\LoggerFactory);

            $factory->registerFactory(new \Timetabio\Library\Factories\ApplicationFactory);
            $factory->registerFactory(new \Timetabio\Library\Factories\LocatorFactory);
            $factory->registerFactory(new \Timetabio\Library\Factories\MapperFactory);
            $factory->registerFactory(new \Timetabio\Library\Factories\IndexerFactory);

            $factory->registerFactory(new \Timetabio\Worker\Factories\ApplicationFactory);
            $factory->registerFactory(new \Timetabio\Worker\Factories\MailFactory);
            $factory->registerFactory(new \Timetabio\Worker\Factories\RunnerFactory);
            $factory->registerFactory(new \Timetabio\Worker\Factories\RendererFactory);
            $factory->registerFactory(new \Timetabio\Worker\Factories\LocatorFactory);

            return $factory;
        }
    }
}
