<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Mails
{
    use Timetabio\Framework\ValueObjects\EmailPerson;

    interface MailInterface
    {
        public function getRecipient(): EmailPerson;

        public function getSubject(): string;

        public function render(): string;
    }
}
