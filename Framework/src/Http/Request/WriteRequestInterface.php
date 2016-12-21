<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Http\Request
{
    interface WriteRequestInterface extends RequestInterface
    {
        /**
         * @param string $name
         * @return bool
         */
        public function hasParam(string $name): bool;

        /**
         * @param string $name
         * @return string
         * @throws \Exception
         */
        public function getParam(string $name);
    }
}
