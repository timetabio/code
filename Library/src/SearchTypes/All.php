<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\SearchTypes
{
    class All implements SearchType
    {
        public function __toString(): string
        {
            return 'all';
        }

        public function getElasticType(): string
        {
            return 'post,feed';
        }
    }
}
