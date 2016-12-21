<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Http\StatusCodes
{
    interface StatusCodeInterface
    {
        /**
         * @return int
         */
        public function getCode(): int;
    }
}
