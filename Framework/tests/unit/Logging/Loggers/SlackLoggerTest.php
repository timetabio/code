<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Logging\Loggers
{
    use Timetabio\Framework\Curl\Curl;
    use Timetabio\Framework\Logging\Logs\EmergencyLog;
    use Timetabio\Framework\Logging\Logs\ErrorLog;
    use Timetabio\Framework\ValueObjects\Uri;

    /**
     * @covers \Timetabio\Framework\Logging\Loggers\SlackLogger
     */
    class SlackLoggerTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var SlackLogger
         */
        private $logger;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject
         */
        private $curl;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject
         */
        private $endpoint;

        protected function setUp()
        {
            $this->curl = $this->getMockBuilder(Curl::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->endpoint = $this->getMockBuilder(Uri::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->logger = new SlackLogger($this->curl, $this->endpoint);
        }

        public function testLogWorks()
        {
            $log = $this->getMockBuilder(ErrorLog::class)
                ->disableOriginalConstructor()
                ->getMock();

            $log->expects($this->once())
                ->method('getMessage')
                ->will($this->returnValue('foo'));

            $log->expects($this->once())
                ->method('getFile')
                ->will($this->returnValue('foo.php'));

            $log->expects($this->once())
                ->method('getLine')
                ->will($this->returnValue(25));

            $log->expects($this->once())
                ->method('getStringTrace')
                ->will($this->returnValue('TRACE'));

            $this->curl->expects($this->once())
                ->method('post')
                ->with(
                    $this->endpoint,
                    ['payload' => '{"text":"*foo*\nin `foo.php:25`\n```TRACE```"}']
                );

            $this->logger->log($log);
        }

        public function testHandles()
        {
            $log = $this->getMockBuilder(EmergencyLog::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->assertTrue($this->logger->handles($log));
        }

        protected function getMockException(string $file, string $line)
        {
            $exception = $this->getMockBuilder(\Exception::class);
        }

        protected function setProperty(\Exception $exception, string $property, $value)
        {
            $ref = new \ReflectionClass($exception);

            $refProperty = $ref->getProperty($property);
            $refProperty->setAccessible(true);
            $refProperty->setValue($exception, $value);
        }
    }
}
