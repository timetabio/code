<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Logging
{
    use Timetabio\Framework\Logging\Loggers\Logger;

    trait LoggerAwareTrait
    {
        /**
         * @var Logger
         */
        private $logger;

        public function setLogger(Logger $logger)
        {
            $this->logger = $logger;
        }

        protected function getLogger(): Logger
        {
            return $this->logger;
        }
    }
}
