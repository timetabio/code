<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\ValueObjects
{
    class Username implements \JsonSerializable
    {
        /**
         * @var string
         */
        private $username;

        public function __construct(string $username)
        {
            $length = mb_strlen($username);

            if ($length < 3 || $length > 20) {
                throw new \Exception('username must be between 3 and 20 characters long');
            }

            if (!preg_match('/^[\w-]+$/u', $username)) {
                throw new \Exception('invalid username');
            }

            $this->username = $username;
        }

        public function __toString(): string
        {
            return $this->username;
        }

        public function jsonSerialize(): string
        {
            return $this->username;
        }
    }
}
