<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
