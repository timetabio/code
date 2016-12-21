<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Access\AccessTypes
{
    class FullAccess implements AccessTypeInterface, \JsonSerializable
    {
        public function jsonSerialize(): string
        {
            return '*';
        }
    }
}
