<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
