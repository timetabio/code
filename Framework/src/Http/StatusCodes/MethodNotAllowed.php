<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Http\StatusCodes
{
    class MethodNotAllowed implements StatusCodeInterface
    {
        /**
         * @return int
         */
        public function getCode(): int
        {
            return 405;
        }
    }
}
