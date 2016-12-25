<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\Backends
{
    /**
     * @covers \Timetabio\Framework\Backends\FileBackend
     */
    class FileBackendTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var FileBackend
         */
        private $fileBackend;

        protected function setUp()
        {
            $this->fileBackend = new FileBackend();
        }

        public function testExists()
        {
            $this->assertTrue($this->fileBackend->exists(__FILE__));
            $this->assertFalse($this->fileBackend->exists(__FILE__ . 'foobarbaz'));
        }

        public function testReadWrite()
        {
            $file = sys_get_temp_dir() . '/' . uniqid();
            $this->fileBackend->write($file, 'foobar');
            $this->assertEquals('foobar', $this->fileBackend->read($file));
        }

        /**
         * @expectedException \Exception
         */
        public function testReadThrows()
        {
            $this->fileBackend->read(__DIR__ . '/' . uniqid());
        }

        /**
         * @expectedException \Exception
         */
        public function testWriteThrows()
        {
            $this->fileBackend->write(__DIR__, '');
        }
    }
}
