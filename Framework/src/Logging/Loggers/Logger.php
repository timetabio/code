<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\Logging\Loggers
{
    use Timetabio\Framework\Logging\Logs\AbstractLog;
    use Timetabio\Framework\Logging\Logs\EmergencyLog;
    use Timetabio\Framework\Logging\Logs\ErrorLog;

    class Logger implements LoggerInterface
    {
        /**
         * @var LoggerInterface[]
         */
        private $loggers = [];

        public function addLogger(LoggerInterface $logger)
        {
            $this->loggers[] = $logger;
        }

        public function error(\Throwable $error)
        {
            $this->log(new ErrorLog($error));
        }

        public function emergency(\Throwable $error)
        {
            $this->log(new EmergencyLog($error));
        }

        public function log(AbstractLog $log)
        {
            foreach ($this->loggers as $logger) {
                if (!$logger->handles($log)) {
                    continue;
                }

                $logger->log($log);
            }
        }

        public function handles(AbstractLog $log): bool
        {
            return true;
        }
    }
}
