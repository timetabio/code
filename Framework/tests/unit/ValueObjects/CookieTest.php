<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\ValueObjects
{
    /**
     * @covers \Timetabio\Framework\ValueObjects\Cookie
     */
    class CookieTest extends \PHPUnit_Framework_TestCase
    {
        public function testGettersWork()
        {
            $cookie = new Cookie('SESSID', 'foobar', '/foo', 42, 'test.timetab.io', true, false);

            $this->assertEquals('SESSID', $cookie->getName());
            $this->assertEquals('foobar', $cookie->getValue());
            $this->assertEquals('/foo', $cookie->getPath());
            $this->assertEquals(42, $cookie->getExpires());
            $this->assertEquals('test.timetab.io', $cookie->getDomain());
            $this->assertEquals(true, $cookie->isSecure());
            $this->assertEquals(false, $cookie->isHttpOnly());
        }
    }
}
