<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\ValueObjects
{
    class Hash
    {
        /**
         * @var string
         */
        private $hash;

        public function __construct(Password $password)
        {
            $this->hash = password_hash((string) $password, PASSWORD_DEFAULT);
        }

        public function __toString(): string
        {
            return $this->hash;
        }
    }
}
