<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\DataStore
{
    /**
     * @covers \Timetabio\Framework\DataStore\RedisBackend
     * @covers \Timetabio\Framework\DataStore\DataStoreInterface
     */
    class RedisBackendTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var RedisBackend
         */
        private $redisBackend;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject
         */
        private $redis;

        protected function setUp()
        {
            $this->redis = $this->getMockBuilder(\Redis::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->redisBackend = new RedisBackend($this->redis, '127.0.0.1', 6379);
        }

        public function testSetWorks()
        {
            $this->redis
                ->expects($this->once())
                ->method('isConnected')
                ->will($this->returnValue(false));

            $this->redis
                ->expects($this->once())
                ->method('connect')
                ->with('127.0.0.1', 6379);

            $this->redis
                ->expects($this->once())
                ->method('set')
                ->with('foo', 'bar');

            $this->redisBackend->set('foo', 'bar');
        }

        public function testHasWorks()
        {
            $this->setUpIsConnected();

            $this->redis
                ->expects($this->once())
                ->method('exists')
                ->with('foo')
                ->will($this->returnValue(true));

            $this->assertTrue($this->redisBackend->has('foo'));
        }

        public function testGetWorks()
        {
            $this->setUpIsConnected();

            $this->redis
                ->expects($this->once())
                ->method('get')
                ->with('answer')
                ->will($this->returnValue(42));

            $this->assertEquals(42, $this->redisBackend->get('answer'));
        }

        public function testRemoveWorks()
        {
            $this->setUpIsConnected();

            $this->redis
                ->expects($this->once())
                ->method('delete')
                ->with('foo');

            $this->redisBackend->remove('foo');
        }

        public function testSetTimeoutWorks()
        {
            $this->setUpIsConnected();

            $this->redis
                ->expects($this->once())
                ->method('expire')
                ->with('foo', 100);

            $this->redisBackend->setTimeout('foo', 100);
        }

        public function testRemoveTimeoutWorks()
        {
            $this->setUpIsConnected();

            $this->redis
                ->expects($this->once())
                ->method('persist')
                ->with('foo');

            $this->redisBackend->removeTimeout('foo');
        }

        private function setUpIsConnected()
        {
            $this->redis
                ->expects($this->once())
                ->method('isConnected')
                ->will($this->returnValue(true));
        }
    }
}
