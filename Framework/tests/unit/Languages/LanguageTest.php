<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Languages
{
    /**
     * @covers \Timetabio\Framework\Languages\LanguageInterface
     * @covers \Timetabio\Framework\Languages\English
     * @covers \Timetabio\Framework\Languages\German
     */
    class LanguageTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @dataProvider provideData
         */
        public function testItWorks(LanguageInterface $language, string $string)
        {
            $this->assertEquals((string) $language, $string);
        }

        public function provideData(): array
        {
            return [
                [new \Timetabio\Framework\Languages\English, 'en_GB'],
                [new \Timetabio\Framework\Languages\German, 'de_CH']
            ];
        }
    }
}
