<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
