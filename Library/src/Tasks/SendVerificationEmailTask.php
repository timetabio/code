<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
