<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
