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
