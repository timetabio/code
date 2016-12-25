<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\Configuration
{
    use Timetabio\Framework\ValueObjects\Uri;

    /**
     * @covers \Timetabio\Framework\Configuration\Configuration
     * @uses   \Timetabio\Framework\ValueObjects\Uri
     */
    class ConfigurationTest extends \PHPUnit_Framework_TestCase
    {
        public function testHasWorks()
        {
            $config = $this->getConfig();

            $this->assertFalse($config->has('qux'));
            $this->assertTrue($config->has('foo'));
            $this->assertTrue($config->has('bool'));
        }

        public function testGetWorks()
        {
            $config = $this->getConfig();

            $this->assertEquals('bar', $config->get('foo'));
            $this->assertEquals(true, $config->get('bool'));
        }

        /**
         * @expectedException \Exception
         * @expectedExceptionMessage configuration key "qux" not found
         */
        public function testGetThrows()
        {
            $this->getConfig()->get('qux');
        }

        /**
         * @expectedException \Exception
         * @expectedExceptionMessageRegExp /error parsing configuration file "(.*)"/
         */
        public function testThrowsForInvalidFile()
        {
            $config = new Configuration(__DIR__ . '/../../data/invalid-config.ini');
            $config->has('baz');
        }

        public function testIsDevelopmentMode()
        {
            $this->assertTrue($this->getConfig()->isDevelopmentMode());
        }

        public function testGetRedisHost()
        {
            $this->assertEquals('127.0.0.1', $this->getConfig()->getRedisHost());
        }

        public function testGetRedisPort()
        {
            $this->assertEquals(6379, $this->getConfig()->getRedisPort());
        }

        public function testGetSlackEndpoint()
        {
            $endpoint = $this->getConfig()->getSlackEndpoint();

            $this->assertInstanceOf(Uri::class, $endpoint);
            $this->assertEquals('http://slack/endpoint', (string) $endpoint);
        }

        private function getConfig()
        {
            return new Configuration(__DIR__ . '/../../data/config.ini');
        }
    }
}
