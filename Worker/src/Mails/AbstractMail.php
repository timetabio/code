<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Worker\Mails
{
    use Timetabio\Framework\Dom\Document;
    use Timetabio\Framework\Mails\MailInterface;
    use Timetabio\Framework\ValueObjects\EmailPerson;

    abstract class AbstractMail implements MailInterface
    {
        /**
         * @var EmailPerson
         */
        private $recipient;

        /**
         * @var Document
         */
        private $template;

        public function __construct(Document $template)
        {
            $this->template = $template;
        }

        public function getRecipient(): EmailPerson
        {
            return $this->recipient;
        }

        public function setRecipient(EmailPerson $recipient)
        {
            $this->recipient = $recipient;
        }

        protected function getTemplate(): Document
        {
            return $this->template;
        }
    }
}
