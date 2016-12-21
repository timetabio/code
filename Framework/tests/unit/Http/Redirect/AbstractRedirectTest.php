<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Http\Redirect
{
    use Timetabio\Framework\ValueObjects\Uri;

    /**
     * @covers \Timetabio\Framework\Http\Redirect\AbstractRedirect
     * @covers \Timetabio\Framework\Http\Redirect\RedirectInterface
     */
    class AbstractRedirectTest extends \PHPUnit_Framework_TestCase
    {
        public function testConstructorWorks()
        {
            $uri = $this->getMockBuilder(Uri::class)
                ->disableOriginalConstructor()
                ->getMock();

            $redirect = $this->getMockBuilder(AbstractRedirect::class)
                ->setConstructorArgs([$uri])
                ->getMockForAbstractClass();

            $this->assertSame($uri, $redirect->getUri());
        }
    }
}
