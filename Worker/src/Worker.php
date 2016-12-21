<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
