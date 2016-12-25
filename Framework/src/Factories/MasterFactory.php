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
    use Timetabio\Framework\Logging\LoggerAwareInterface;
    use Timetabio\Framework\Translation\TranslatorAwareInterface;

    class MasterFactory implements MasterFactoryInterface
    {
        /**
         * @var array
         */
        private $methods;

        /**
         * @var ConfigurationInterface
         */
        private $configuration;

        public function __construct(ConfigurationInterface $configuration)
        {
            $this->configuration = $configuration;
        }

        public function registerFactory(ChildFactoryInterface $factory)
        {
            $reflection = new \ReflectionClass($factory);

            $factory->setMasterFactory($this);

            foreach ($reflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
                $methodName = $method->getName();

                if (substr($methodName, 0, 6) !== 'create') {
                    continue;
                }

                if (isset($this->methods[$methodName])) {
                    throw new \RuntimeException('method "' . $methodName . '" is already registered');
                }

                $this->methods[$methodName] = $factory;
            }
        }

        public function getConfiguration(): ConfigurationInterface
        {
            return $this->configuration;
        }

        public function __call(string $name, array $arguments)
        {
            if (!isset($this->methods[$name])) {
                throw new \InvalidArgumentException('no method found for name "' . $name . '"');
            }

            $factory = $this->methods[$name];
            $result = call_user_func_array([$factory, $name], $arguments);

            if ($result instanceof LoggerAwareInterface) {
                $result->setLogger($this->createLoggers());
            }

            if ($result instanceof TranslatorAwareInterface) {
                $result->setTranslator($this->createGettext());
            }

            return $result;
        }
    }
}
