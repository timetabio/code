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
    /**
     * @covers \Timetabio\Framework\ValueObjects\EmailAddress
     */
    class EmailAddressTest extends \PHPUnit_Framework_TestCase
    {
        public function testConstructorWorks()
        {
            $email = new EmailAddress('foo@example.com');

            $this->assertEquals('foo@example.com', (string) $email);
            $this->assertEquals(json_encode('foo@example.com'), json_encode($email));
        }

        /**
         * @expectedException \Exception
         */
        public function testConstructorThrowsForInvalidEmail()
        {
            $email = new EmailAddress('foo@');
        }
    }
}
