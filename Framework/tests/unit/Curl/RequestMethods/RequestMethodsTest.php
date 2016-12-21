<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Curl
{
    use Timetabio\Framework\Curl\RequestMethods\{
        Delete, Get, Head, Patch, Post
    };
    use Timetabio\Framework\Curl\RequestMethods\RequestMethodInterface;

    /**
     * @covers \Timetabio\Framework\Curl\RequestMethods\Post
     * @covers \Timetabio\Framework\Curl\RequestMethods\Get
     * @covers \Timetabio\Framework\Curl\RequestMethods\Delete
     * @covers \Timetabio\Framework\Curl\RequestMethods\Head
     * @covers \Timetabio\Framework\Curl\RequestMethods\Patch
     * @covers \Timetabio\Framework\Curl\RequestMethods\RequestMethodInterface
     */
    class RequestMethodsTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @dataProvider provideData
         */
        public function testToStringWorks(RequestMethodInterface $requestMethod, string $method)
        {
            $this->assertEquals($method, (string) $requestMethod);
        }

        public function provideData(): array
        {
            return [
                [new Get, 'GET'],
                [new Post, 'POST'],
                [new Delete, 'DELETE'],
                [new Head, 'HEAD'],
                [new Patch, 'PATCH']
            ];
        }
    }
}
