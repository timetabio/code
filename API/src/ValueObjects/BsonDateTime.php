<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\ValueObjects
{
    use MongoDB\BSON\UTCDateTime;

    class BsonDateTime
    {
        /**
         * @var UTCDateTime
         */
        private $value;

        public function __construct(int $time = null)
        {
            if ($time === null) {
                $time = time();
            }

            $this->value = new UTCDateTime($time * 1000);
        }

        public function getValue(): UTCDateTime
        {
            return $this->value;
        }
    }
}
