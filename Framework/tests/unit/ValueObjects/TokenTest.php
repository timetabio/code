<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
