<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\ValueObjects
{
    use Timetabio\Framework\ValueObjects\Token;

    class FileToken extends Token
    {
        public function __construct($token = null, $length = 128)
        {
            parent::__construct($token, $length);
        }
    }
}
