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
     * @covers \Timetabio\Framework\ValueObjects\EmailPerson
     * @uses   \Timetabio\Framework\ValueObjects\EmailAddress
     */
    class EmailPersonTest extends \PHPUnit_Framework_TestCase
    {
        public function testConstructorWorks()
        {
            $email = $this->getMockBuilder(EmailAddress::class)
                ->disableOriginalConstructor()
                ->getMock();

            $email->expects($this->exactly(2))
                ->method('__toString')
                ->will($this->returnValue('root@example.com'));

            $this->assertEquals('Foo Bar <root@example.com>', (string) new EmailPerson($email, 'Foo Bar'));
            $this->assertEquals('root@example.com', (string) new EmailPerson($email));
        }
    }
}
