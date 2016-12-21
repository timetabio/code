<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\ValueObjects
{
    /**
     * @covers \Timetabio\Framework\ValueObjects\Uri
     */
    class UriTest extends \PHPUnit_Framework_TestCase
    {
        public function testGettersWork()
        {
            $uri = new Uri('https://google.com/foo/bar?answer=42');

            $this->assertEquals('https', $uri->getScheme());
            $this->assertEquals('google.com', $uri->getHost());
            $this->assertEquals('/foo/bar', $uri->getPath());
            $this->assertEquals(42, $uri->getQueryParam('answer'));
            $this->assertTrue($uri->hasQueryParam('answer'));
            $this->assertFalse($uri->hasQueryParam('foo'));
            $this->assertEquals(['foo', 'bar'], $uri->getExplodedPath());
        }

        /**
         * @expectedException \Exception
         * @expectedExceptionMessage query param "foo" not found
         */
        public function testGetQueryParameterThrows()
        {
            $uri = new Uri('https', 'google.com', '/foo/bar', ['answer' => 42]);
            $uri->getQueryParam('foo');
        }

        /**
         * @dataProvider provideUris
         */
        public function testToStringWorks(Uri $uri, string $expected)
        {
            $this->assertEquals($expected, (string) $uri);
        }

        public function provideUris(): array
        {
            return [
                [
                    new Uri('https://google.com'),
                    'https://google.com/'
                ],
                [
                    new Uri('https://github.com/timetabio/timetab.io?a=10'),
                    'https://github.com/timetabio/timetab.io?a=10'
                ],
                [
                    new Uri('/timetabio/timetab.io'),
                    '/timetabio/timetab.io'
                ],
                [
                    new Uri('/?answer=42'),
                    '/?answer=42'
                ]
            ];
        }
    }
}
