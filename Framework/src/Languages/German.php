<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Languages
{
    class German implements LanguageInterface
    {
        public function __toString(): string
        {
            return 'de_CH';
        }
    }
}
