<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Curl
{
    class RequestHeaders
    {
        /**
         * @var array
         */
        private $headers = [];

        public function set(string $name, string $value)
        {
            $this->headers[strtolower($name)] = $name . ':' . $value;
        }

        public function toArray(): array
        {
            return array_values($this->headers);
        }
    }
}
