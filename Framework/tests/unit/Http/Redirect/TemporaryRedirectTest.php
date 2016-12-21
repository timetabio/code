<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Http\Redirect
{
    use Timetabio\Framework\Http\StatusCodes\SeeOther;
    use Timetabio\Framework\ValueObjects\Uri;

    /**
     * @covers \Timetabio\Framework\Http\Redirect\TemporaryRedirect
     * @uses   \Timetabio\Framework\Http\Redirect\AbstractRedirect
     */
    class TemporaryRedirectTest extends \PHPUnit_Framework_TestCase
    {
        public function testGetStatusCodeWorks()
        {
            $uri = $this->getMockBuilder(Uri::class)
                ->disableOriginalConstructor()
                ->getMock();

            $redirect = new TemporaryRedirect($uri);

            $this->assertInstanceOf(SeeOther::class, $redirect->getStatusCode());
        }
    }
}
