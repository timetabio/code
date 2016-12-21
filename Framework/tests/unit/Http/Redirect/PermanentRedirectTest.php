<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Http\Redirect
{
    use Timetabio\Framework\Http\StatusCodes\MovedPermanently;
    use Timetabio\Framework\ValueObjects\Uri;

    /**
     * @covers \Timetabio\Framework\Http\Redirect\PermanentRedirect
     * @uses   \Timetabio\Framework\Http\Redirect\AbstractRedirect
     */
    class PermanentRedirectTest extends \PHPUnit_Framework_TestCase
    {
        public function testGetStatusCodeWorks()
        {
            $uri = $this->getMockBuilder(Uri::class)
                ->disableOriginalConstructor()
                ->getMock();

            $redirect = new PermanentRedirect($uri);

            $this->assertInstanceOf(MovedPermanently::class, $redirect->getStatusCode());
        }
    }
}
