<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Logging
{
    use Timetabio\Framework\Logging\Loggers\Logger;

    interface LoggerAwareInterface
    {
        public function setLogger(Logger $logger);
    }
}
