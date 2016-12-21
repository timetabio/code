<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
