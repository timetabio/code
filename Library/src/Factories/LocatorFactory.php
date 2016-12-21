<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class LocatorFactory extends AbstractChildFactory
    {
        public function createUserRoleLocator(): \Timetabio\Library\Locators\UserRoleLocator
        {
            return new \Timetabio\Library\Locators\UserRoleLocator;
        }

        public function createSearchTypeLocator(): \Timetabio\Library\Locators\SearchTypeLocator
        {
            return new \Timetabio\Library\Locators\SearchTypeLocator;
        }
    }
}
