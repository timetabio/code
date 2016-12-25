<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\ValueObjects
{
    /**
     * @covers \Timetabio\Framework\ValueObjects\Header
     */
    class HeaderTest extends \PHPUnit_Framework_TestCase
    {
        public function testConstructorWorks()
        {
            $header = new Header('content-type', 'text/plain');

            $this->assertEquals('content-type: text/plain', (string) $header);
        }

        public function testGettersWork()
        {
            $header = new Header('content-type', 'text/plain');

            $this->assertEquals('content-type', $header->getName());
            $this->assertEquals('text/plain', $header->getValue());
        }
    }
}
