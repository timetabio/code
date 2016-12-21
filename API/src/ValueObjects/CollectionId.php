<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\ValueObjects
{
    use Timetabio\Framework\ValueObjects\Token;

    /**
     * @deprecated
     */
    class CollectionId extends Token
    {
        public function __construct(string $token = null, int $length = 32)
        {
            parent::__construct($token, $length);
        }
    }
}
