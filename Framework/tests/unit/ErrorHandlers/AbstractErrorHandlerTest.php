<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\ErrorHandlers
{
    /**
     * @covers \Timetabio\Framework\ErrorHandlers\AbstractErrorHandler
     */
    class AbstractErrorHandlerTest extends \PHPUnit_Framework_TestCase
    {
        public function testHandleErrorThrows()
        {
            $errorHandler = $this->getMockBuilder(AbstractErrorHandler::class)
                ->disableOriginalConstructor()
                ->getMockForAbstractClass();

            try {
                $errorHandler->handleError(42, 'this is an error', '/dev/null', 25);
            } catch (\ErrorException $exception) {
                $this->assertEquals(-1, $exception->getCode());
                $this->assertEquals(42, $exception->getSeverity());
                $this->assertEquals('this is an error', $exception->getMessage());
                $this->assertEquals('/dev/null', $exception->getFile());
                $this->assertEquals(25, $exception->getLine());
            }
        }
    }
}
