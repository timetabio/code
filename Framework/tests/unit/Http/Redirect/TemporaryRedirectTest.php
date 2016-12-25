<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
