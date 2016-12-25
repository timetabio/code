<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
