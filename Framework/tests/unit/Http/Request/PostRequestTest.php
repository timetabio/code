<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\Http\Request
{
    use Timetabio\Framework\ValueObjects\Uri;

    /**
     * @covers \Timetabio\Framework\Http\Request\AbstractRequest
     * @covers \Timetabio\Framework\Http\Request\AbstractWriteRequest
     * @covers \Timetabio\Framework\Http\Request\PostRequest
     * @covers \Timetabio\Framework\Http\Request\GetRequest
     * @covers \Timetabio\Framework\Http\Request\PutRequest
     * @covers \Timetabio\Framework\Http\Request\PatchRequest
     * @covers \Timetabio\Framework\Http\Request\DeleteRequest
     * @uses   \Timetabio\Framework\Http\Headers\Authorization
     */
    class PostRequestTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var PostRequest
         */
        private $request;

        /**
         * @var array
         */
        private $server;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject
         */
        private $uri;

        protected function setUp()
        {
            $this->server = [
                'HTTP_USER_AGENT' => 'curl/7.43.0',
                'REMOTE_ADDR' => '127.0.0.1',
                'HTTP_AUTHORIZATION' => 'Bearer Foobar'
            ];

            $cookies = [
                'foo' => 'bar'
            ];

            $params = [
                'baz' => 'qux'
            ];

            $files = [
                'file' => 'tata'
            ];

            $this->uri = $this->getMockBuilder(Uri::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->request = new PostRequest($this->uri, $this->server, $cookies, $params, $files);
        }

        public function testGetUriWorks()
        {
            $this->assertSame($this->uri, $this->request->getUri());
        }

        public function testGetUserAgentWorks()
        {
            $this->assertEquals($this->server['HTTP_USER_AGENT'], $this->request->getUserAgent());
        }

        public function testGetUserIpWorks()
        {
            $this->assertEquals($this->server['REMOTE_ADDR'], $this->request->getUserIp());
        }

        public function testHasCookieWorks()
        {
            $this->assertFalse($this->request->hasCookie('baz'));
            $this->assertTrue($this->request->hasCookie('foo'));
        }

        public function testGetCookieWorks()
        {
            $this->assertEquals('bar', $this->request->getCookie('foo'));
        }

        /**
         * @expectedException \Exception
         * @expectedExceptionMessage cookie with name "baz" not found
         */
        public function testGetCookieThrowsForNonExisting()
        {
            $this->request->getCookie('baz');
        }

        public function testHasParamWorks()
        {
            $this->assertFalse($this->request->hasParam('sweg'));
            $this->assertTrue($this->request->hasParam('baz'));
        }

        public function testGetParamWorks()
        {
            $this->assertEquals('qux', $this->request->getParam('baz'));
        }

        /**
         * @expectedException \Exception
         * @expectedExceptionMessage param with name "foobar" was not found in request
         */
        public function testGetParamThrowsForNonExisting()
        {
            $this->request->getParam('foobar');
        }

        public function testHasFileWorks()
        {
            $this->assertTrue($this->request->hasFile('file'));
            $this->assertFalse($this->request->hasFile('foo'));
        }

        /**
         * @expectedException \Exception
         * @expectedExceptionMessage file with name "foo" was not found in request
         */
        public function testGetFileThrowsForNonExisting()
        {
            $this->request->getFile('foo');
        }

        public function testGetAuthorizationWorks()
        {
            $auth = $this->request->getAuthorization();

            $this->assertEquals($auth->getType(), 'Bearer');
            $this->assertEquals($auth->getToken(), 'Foobar');
        }

        public function testHasAuthorizationWorks()
        {
            $request = new PostRequest($this->uri, [], [], [], []);

            $this->assertFalse($request->hasAuthorization());
            $this->assertTrue($this->request->hasAuthorization());
        }
    }
}
