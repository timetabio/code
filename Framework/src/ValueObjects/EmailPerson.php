<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
