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
    class FeedId extends Token
    {
        /**
         * @deprecated
         */
        public function __construct(string $token = null, int $length = 32)
        {
            parent::__construct($token, $length);
        }
    }
}
