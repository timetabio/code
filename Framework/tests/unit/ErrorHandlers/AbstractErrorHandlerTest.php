<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
