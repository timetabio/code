<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Factories
{
    class LoggerFactory extends AbstractChildFactory
    {
        /**
         * @var \Timetabio\Framework\Logging\Loggers\Logger
         */
        private $logger;

        public function createSlackLogger(): \Timetabio\Framework\Logging\Loggers\SlackLogger
        {
            return new \Timetabio\Framework\Logging\Loggers\SlackLogger(
                $this->getMasterFactory()->createCurl(),
                $this->getMasterFactory()->getConfiguration()->getSlackEndpoint()
            );
        }

        public function createNsaLogger(): \Timetabio\Framework\Logging\Loggers\NsaLogger
        {
            return new \Timetabio\Framework\Logging\Loggers\NsaLogger(
                $this->getMasterFactory()->createFileBackend(),
                $this->getMasterFactory()->getConfiguration()->get('nsaLog')
            );
        }

        public function createLogger(): \Timetabio\Framework\Logging\Loggers\Logger
        {
            return new \Timetabio\Framework\Logging\Loggers\Logger;
        }

        public function createLoggers(): \Timetabio\Framework\Logging\Loggers\Logger
        {
            if ($this->logger === null) {
                $this->logger = $this->createLogger();
                // $this->logger->addLogger($this->createSlackLogger());
                $this->logger->addLogger($this->createNsaLogger());
            }

            return $this->logger;
        }
    }
}
