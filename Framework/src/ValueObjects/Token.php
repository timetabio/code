<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\ValueObjects
{
    class Token
    {
        /**
         * @var string
         */
        private $token;

        public function __construct(string $token = null, int $length = 48)
        {
            $this->token = $token;

            if ($this->token === null) {
                $this->token = bin2hex(openssl_random_pseudo_bytes($length / 2));
            }
        }

        public function __toString(): string
        {
            return $this->token;
        }
    }
}
