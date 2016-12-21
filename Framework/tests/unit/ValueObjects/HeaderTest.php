<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
