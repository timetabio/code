<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\SearchTypes
{
    class Post implements SearchType
    {
        public function __toString(): string
        {
            return 'post';
        }

        public function getElasticType(): string
        {
            return 'post';
        }
    }
}
