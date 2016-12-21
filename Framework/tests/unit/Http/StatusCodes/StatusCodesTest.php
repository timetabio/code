<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Http\StatusCodes
{
    /**
     * @covers \Timetabio\Framework\Http\StatusCodes\Created
     * @covers \Timetabio\Framework\Http\StatusCodes\InternalServerError
     * @covers \Timetabio\Framework\Http\StatusCodes\MovedPermanently
     * @covers \Timetabio\Framework\Http\StatusCodes\NotFound
     * @covers \Timetabio\Framework\Http\StatusCodes\SeeOther
     * @covers \Timetabio\Framework\Http\StatusCodes\BadRequest
     * @covers \Timetabio\Framework\Http\StatusCodes\MethodNotAllowed
     * @covers \Timetabio\Framework\Http\StatusCodes\Unauthorized
     * @covers \Timetabio\Framework\Http\StatusCodes\Forbidden
     * @covers \Timetabio\Framework\Http\StatusCodes\StatusCodeInterface
     */
    class StatusCodesTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @dataProvider provideData
         */
        public function testGetCodeWorks(StatusCodeInterface $statusCode, int $code)
        {
            $this->assertEquals($code, $statusCode->getCode());
        }

        public function provideData(): array
        {
            return [
                [new Created, 201],
                [new InternalServerError, 500],
                [new MovedPermanently, 301],
                [new NotFound, 404],
                [new SeeOther, 303],
                [new BadRequest, 400],
                [new MethodNotAllowed, 405],
                [new Unauthorized, 401],
                [new Forbidden, 403],
            ];
        }
    }
}
