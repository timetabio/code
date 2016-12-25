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
     * @covers \Timetabio\Framework\ValueObjects\Token
     */
    class TokenTest extends \PHPUnit_Framework_TestCase
    {
        public function testGettersWork()
        {
            $token = new Token('foobar');

            $this->assertEquals('foobar', $token);
        }

        public function testTokenGenerateWorks()
        {
            $token = new Token;

            $this->assertNotEmpty((string) $token);
            $this->assertEquals(48, strlen($token));
        }
    }
}
