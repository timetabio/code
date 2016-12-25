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
    use Timetabio\Framework\DataStore\RedisBackend;
    use Timetabio\Framework\Logging\LoggerAwareInterface;
    use Timetabio\Framework\Logging\LoggerAwareTrait;
    use Timetabio\Worker\Locators\RunnerLocator;

    class Worker implements LoggerAwareInterface
    {
        use LoggerAwareTrait;

        /**
         * @var RedisBackend
         */
        private $redisBackend;

        /**
         * @var RunnerLocator
         */
        private $runnerLocator;

        public function __construct(RedisBackend $redisBackend, RunnerLocator $runnerLocator)
        {
            $this->redisBackend = $redisBackend;
            $this->runnerLocator = $runnerLocator;
        }

        public function start()
        {
            do {
                $this->process();
                sleep(1);
            } while (true);
        }

        private function process()
        {
            $event = unserialize($this->redisBackend->zLpop('task_queue'));

            if (!$event) {
                return;
            }

            echo 'Running task ' . get_class($event) . PHP_EOL;

            try {
                $runner = $this->runnerLocator->locate($event);
                $runner->run($event);
            } catch (\Throwable $exception) {
                $this->logger->emergency($exception);

                echo $exception->getMessage() . PHP_EOL;
                echo $exception->getTraceAsString() . PHP_EOL;
            }
        }
    }
}
