<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Curl
{
    use Timetabio\Framework\Curl\Credentials\CredentialsInterface;
    use Timetabio\Framework\Curl\RequestMethods\Delete;
    use Timetabio\Framework\Curl\RequestMethods\Get;
    use Timetabio\Framework\Curl\RequestMethods\Head;
    use Timetabio\Framework\Curl\RequestMethods\Post;
    use Timetabio\Framework\ValueObjects\Uri;

    /**
     * @covers \Timetabio\Framework\Curl\Curl
     */
    class CurlTest extends \PHPUnit_Framework_TestCase
    {
        public function testPostWorks()
        {
            $handler = $this->getMockBuilder(CurlHandler::class)
                ->disableOriginalConstructor()
                ->getMock();

            $response = $this->getMockBuilder(Response::class)
                ->disableOriginalConstructor()
                ->getMock();

            $credentials = $this->getMockBuilder(CredentialsInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

            $uri = $this->getMockBuilder(Uri::class)
                ->disableOriginalConstructor()
                ->getMock();

            $handler
                ->expects($this->once())
                ->method('executeRequest')
                ->with($uri, new Post, ['foo' => 'bar'], $credentials)
                ->will($this->returnValue($response));

            $curl = new Curl($handler);

            $this->assertEquals($response, $curl->post($uri, ['foo' => 'bar'], $credentials));
        }

        public function testGetWorks()
        {
            $handler = $this->getMockBuilder(CurlHandler::class)
                ->disableOriginalConstructor()
                ->getMock();

            $response = $this->getMockBuilder(Response::class)
                ->disableOriginalConstructor()
                ->getMock();

            $credentials = $this->getMockBuilder(CredentialsInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

            $uri = $this->getMockBuilder(Uri::class)
                ->disableOriginalConstructor()
                ->getMock();

            $handler
                ->expects($this->once())
                ->method('executeRequest')
                ->with($uri, new Get, [], $credentials)
                ->will($this->returnValue($response));

            $curl = new Curl($handler);

            $this->assertEquals($response, $curl->get($uri, $credentials));
        }

        public function testDeleteWorks()
        {
            $handler = $this->getMockBuilder(CurlHandler::class)
                ->disableOriginalConstructor()
                ->getMock();

            $response = $this->getMockBuilder(Response::class)
                ->disableOriginalConstructor()
                ->getMock();

            $credentials = $this->getMockBuilder(CredentialsInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

            $uri = $this->getMockBuilder(Uri::class)
                ->disableOriginalConstructor()
                ->getMock();

            $handler
                ->expects($this->once())
                ->method('executeRequest')
                ->with($uri, new Delete, [], $credentials)
                ->will($this->returnValue($response));

            $curl = new Curl($handler);

            $this->assertEquals($response, $curl->delete($uri, $credentials));
        }

        public function testHeadWorks()
        {
            $handler = $this->getMockBuilder(CurlHandler::class)
                ->disableOriginalConstructor()
                ->getMock();

            $response = $this->getMockBuilder(Response::class)
                ->disableOriginalConstructor()
                ->getMock();

            $credentials = $this->getMockBuilder(CredentialsInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

            $uri = $this->getMockBuilder(Uri::class)
                ->disableOriginalConstructor()
                ->getMock();

            $handler
                ->expects($this->once())
                ->method('executeRequest')
                ->with($uri, new Head, [], $credentials)
                ->will($this->returnValue($response));

            $curl = new Curl($handler);

            $this->assertEquals($response, $curl->head($uri, $credentials));
        }
    }
}
