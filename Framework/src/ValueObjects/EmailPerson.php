<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\ValueObjects
{
    class EmailPerson
    {
        /**
         * @var EmailAddress
         */
        private $email;

        /**
         * @var string
         */
        private $name;

        public function __construct(EmailAddress $email, string $name = '')
        {
            $this->email = $email;
            $this->name = $name;
        }

        public function getEmail(): EmailAddress
        {
            return $this->email;
        }

        public function getName(): string
        {
            return $this->name;
        }

        public function __toString(): string
        {
            if ($this->name === '') {
                return $this->email;
            }

            return $this->name . ' <' . $this->email . '>';
        }
    }
}
