<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Models\Verify
{
    use Timetabio\Framework\ValueObjects\EmailAddress;
    use Timetabio\Framework\ValueObjects\EmailPerson;

    class ResendModel extends VerifyModel
    {
        /**
         * @var EmailAddress
         */
        private $email;

        /**
         * @var EmailPerson
         */
        private $person;

        public function getEmail(): EmailAddress
        {
            return $this->email;
        }

        public function setEmail(EmailAddress $email)
        {
            $this->email = $email;
        }

        public function setEmailPerson(EmailPerson $person)
        {
            $this->person = $person;
        }

        public function getEmailPerson(): EmailPerson
        {
            return $this->person;
        }
    }
}
