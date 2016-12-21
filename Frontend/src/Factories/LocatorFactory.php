<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class LocatorFactory extends AbstractChildFactory
    {
        use FactoryTypeHintTrait;

        public function createStatusCodeLocator(): \Timetabio\Frontend\Locators\StatusCodeLocator
        {
            return new \Timetabio\Frontend\Locators\StatusCodeLocator;
        }

        public function createSearchTabLocator(): \Timetabio\Frontend\Locators\SearchTabLocator
        {
            return new \Timetabio\Frontend\Locators\SearchTabLocator;
        }
    }
}
