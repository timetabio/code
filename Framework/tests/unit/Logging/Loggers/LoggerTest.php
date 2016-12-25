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

    /**
     * @covers \Timetabio\Framework\Logging\Loggers\Logger
     */
    class LoggerTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var Logger
         */
        private $logger;

        protected function setUp()
        {
            $this->logger = new Logger;
        }

        public function testLogWorks()
        {
            $log = $this->getMockBuilder(AbstractLog::class)
                ->disableOriginalConstructor()
                ->getMockForAbstractClass();

            $childLogger = $this->getMockBuilder(LoggerInterface::class)
                ->getMockForAbstractClass();

            $childLogger->expects($this->once())
                ->method('handles')
                ->with($log)
                ->will($this->returnValue(true));

            $childLogger->expects($this->once())
                ->method('log')
                ->with($log);

            $this->logger->addLogger($childLogger);
            $this->logger->log($log);
        }

        public function testHandlesWorks()
        {
            $log = $this->getMockBuilder(AbstractLog::class)
                ->disableOriginalConstructor()
                ->getMockForAbstractClass();

            $this->assertTrue($this->logger->handles($log));
        }
    }
}
