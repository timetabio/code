<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\SearchTypes
{
    interface SearchType
    {
        public function __toString(): string;

        public function getElasticType(): string;
    }
}
