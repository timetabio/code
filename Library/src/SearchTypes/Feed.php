<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\SearchTypes
{
    class Feed implements SearchType
    {
        public function __toString(): string
        {
            return 'feed';
        }

        public function getElasticType(): string
        {
            return 'feed';
        }
    }
}
