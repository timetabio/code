<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Logging
{
    use Timetabio\Framework\Logging\Loggers\Logger;

    /**
     * @covers \Timetabio\Framework\Logging\LoggerAwareTrait
     * @covers \Timetabio\Framework\Logging\LoggerAwareInterface
     */
    class LoggerAwareTraitTest extends \PHPUnit_Framework_TestCase
    {
        public function testGetterAndSetterWorks()
        {
            $logger = $this->getMockBuilder(Logger::class)
                ->disableOriginalConstructor()
                ->getMock();

            $loggerAware = $this->getMockForTrait(LoggerAwareTrait::class);

            $closure = function () {
                return $this->getLogger();
            };

            $getLogger = $closure->bindTo($loggerAware, $loggerAware);

            $loggerAware->setLogger($logger);

            $this->assertSame($logger, $getLogger());
        }
    }
}
