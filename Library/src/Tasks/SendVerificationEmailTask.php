<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\Tasks
{
    use Timetabio\Framework\ValueObjects\EmailPerson;
    use Timetabio\Framework\ValueObjects\Token;

    class SendVerificationEmailTask implements TaskInterface
    {
        /**
         * @var EmailPerson
         */
        private $person;

        /**
         * @var Token
         */
        private $token;

        public function __construct(EmailPerson $person, Token $token)
        {
            $this->person = $person;
            $this->token = $token;
        }

        public function getPerson(): EmailPerson
        {
            return $this->person;
        }

        public function getToken(): Token
        {
            return $this->token;
        }

        public function getPriority(): \Timetabio\Library\TaskPriorities\Priority
        {
            return new \Timetabio\Library\TaskPriorities\Normal;
        }
    }
}
