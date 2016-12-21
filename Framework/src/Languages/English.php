<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Languages
{
    class English implements LanguageInterface
    {
        public function __toString(): string
        {
            return 'en_GB';
        }
    }
}
