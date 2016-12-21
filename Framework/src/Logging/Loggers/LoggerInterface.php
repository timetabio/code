<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Logging\Loggers
{
    use Timetabio\Framework\Logging\Logs\AbstractLog;

    interface LoggerInterface
    {
        public function log(AbstractLog $log);

        public function handles(AbstractLog $log): bool;
    }
}
