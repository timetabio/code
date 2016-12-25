<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
