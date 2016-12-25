<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\Curl
{
    /**
     * @covers \Timetabio\Framework\Curl\Response
     */
    class ResponseTest extends \PHPUnit_Framework_TestCase
    {
        public function testGettersWork()
        {
            $response = new Response(404, 'not found');

            $this->assertEquals(404, $response->getCode());
            $this->assertEquals('not found', $response->getBody());
        }

        public function testJsonDecodeWorks()
        {
            $response = new Response(200, '{"message": "hello world"}');

            $this->assertEquals(['message' => 'hello world'], $response->getJsonDecodedBody());
        }
    }
}
