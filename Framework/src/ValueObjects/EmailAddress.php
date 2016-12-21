<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\ValueObjects
{
    class EmailAddress implements \JsonSerializable
    {
        /**
         * @var string
         */
        private $email;

        public function __construct(string $email)
        {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new \Exception('invalid email address');
            }

            $this->email = $email;
        }

        public function jsonSerialize(): string
        {
            return (string) $this;
        }

        public function __toString(): string
        {
            return $this->email;
        }
    }
}
