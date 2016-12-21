<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Curl
{
    class Response
    {
        /**
         * @var int
         */
        private $code;

        /**
         * @var string
         */
        private $body;

        public function __construct(int $code, string $body)
        {
            $this->code = $code;
            $this->body = $body;
        }

        public function getCode(): int
        {
            return $this->code;
        }

        public function getBody(): string
        {
            return $this->body;
        }

        public function getJsonDecodedBody()
        {
            return json_decode($this->body, true);
        }
    }
}
