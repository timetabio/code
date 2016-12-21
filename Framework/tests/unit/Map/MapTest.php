<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Map
{
    /**
     * @covers \Timetabio\Framework\Map\Map
     */
    class MapTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var Map
         */
        private $map;

        protected function setUp()
        {
            $this->map = new Map(['foo' => 'bar', 'baz' => 'qux']);
        }

        public function testHasWorks()
        {
            $this->assertTrue($this->map->has('foo'));
            $this->assertFalse($this->map->has('foo-bar'));

            $this->assertTrue($this->map->has('baz'));
            $this->assertFalse($this->map->has('baz-qux'));
        }

        public function testGetIteratorWorks()
        {
            $arr = [];

            foreach ($this->map as $key => $value) {
                $arr[$key] = $value;
            }

            $this->assertEquals($arr, ['foo' => 'bar', 'baz' => 'qux']);
        }

        public function testGetWorks()
        {
            $this->assertEquals('bar', $this->map->get('foo'));
            $this->assertEquals('qux', $this->map->get('baz'));
        }

        /**
         * @expectedException \Exception
         * @expectedExceptionMessage key "foo-bar" not found in map
         */
        public function testGetThrowsIfKeyIsNotFound()
        {
            $this->map->get('foo-bar');
        }

        public function testSetWorks()
        {
            $this->map->set('a', 1);
            $this->assertEquals(1, $this->map->get('a'));
        }

        public function testRemoveWorks()
        {
            $this->assertTrue($this->map->has('foo'));
            $this->map->remove('foo');
            $this->assertFalse($this->map->has('foo'));
        }
    }
}
