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
