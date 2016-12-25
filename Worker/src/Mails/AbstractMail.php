<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
