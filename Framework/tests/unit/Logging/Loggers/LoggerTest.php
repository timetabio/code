<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
