<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\ValueObjects
{
    class Password
    {
        /**
         * @var string
         */
        private $password;

        public function __construct(string $password)
        {
            $length = strlen($password);

            if ($length < 8 || $length > 72) {
                throw new \Exception('password must be between 8 and 72 characters');
            }

            $this->password = $password;
        }

        public function verify(string $hash): bool
        {
            return password_verify($this->password, $hash);
        }

        public function __toString(): string
        {
            return $this->password;
        }
    }
}
