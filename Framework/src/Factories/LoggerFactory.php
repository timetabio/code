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
