<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
