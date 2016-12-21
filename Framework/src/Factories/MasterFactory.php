<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
