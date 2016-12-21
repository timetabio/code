<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
