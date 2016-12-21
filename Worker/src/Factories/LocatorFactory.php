<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Worker\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class LocatorFactory extends AbstractChildFactory
    {
        public function createRunnerLocator(): \Timetabio\Worker\Locators\RunnerLocator
        {
            return new \Timetabio\Worker\Locators\RunnerLocator(
                $this->getMasterFactory()
            );
        }

        public function createTaskLocator(): \Timetabio\Worker\Locators\TaskLocator
        {
            return new \Timetabio\Worker\Locators\TaskLocator(
                $this->getMasterFactory()
            );
        }

        public function createStatusCodeLocator(): \Timetabio\Worker\Locators\StatusCodeLocator
        {
            return new \Timetabio\Worker\Locators\StatusCodeLocator;
        }
    }
}
