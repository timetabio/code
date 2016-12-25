<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\Controllers
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Handlers\PostHandlerInterface;
    use Timetabio\Framework\Handlers\PreHandlerInterface;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Handlers\ResponseHandlerInterface;
    use Timetabio\Framework\Handlers\TransformationHandlerInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Http\Response\ResponseInterface;
    use Timetabio\Framework\Models\AbstractModel;

    /**
     * @covers \Timetabio\Framework\Controllers\AbstractController
     * @covers \Timetabio\Framework\Controllers\GetController
     * @covers \Timetabio\Framework\Controllers\PostController
     */
    class AbstractControllerTest extends \PHPUnit_Framework_TestCase
    {
        public function testProcessRequest()
        {
            $model = $this->getMockBuilder(AbstractModel::class)
                ->disableOriginalConstructor()
                ->getMock();

            $response = $this->getMockBuilder(ResponseInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

            $response
                ->expects($this->once())
                ->method('setBody')
                ->with('foobar');

            $request = $this->getMockBuilder(RequestInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

            $preHandler = $this->getMockBuilder(PreHandlerInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

            $preHandler
                ->expects($this->once())
                ->method('execute')
                ->with($request, $model);

            $requestHandler = $this->getMockBuilder(RequestHandlerInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

            $requestHandler
                ->expects($this->once())
                ->method('execute')
                ->with($request, $model);

            $queryHandler = $this->getMockBuilder(QueryHandlerInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

            $queryHandler
                ->expects($this->once())
                ->method('execute')
                ->with($model);

            $commandHandler = $this->getMockBuilder(CommandHandlerInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

            $commandHandler
                ->expects($this->once())
                ->method('execute')
                ->with($model);

            $transformationHandler = $this->getMockBuilder(TransformationHandlerInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

            $transformationHandler
                ->expects($this->once())
                ->method('execute')
                ->with($model)
                ->will($this->returnValue('foobar'));

            $responseHandler = $this->getMockBuilder(ResponseHandlerInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

            $responseHandler
                ->expects($this->once())
                ->method('execute')
                ->with($response, $model);

            $postHandler = $this->getMockBuilder(PostHandlerInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

            $postHandler
                ->expects($this->once())
                ->method('execute')
                ->with($model);

            $controller = $this->getMockBuilder(AbstractController::class)
                ->setConstructorArgs([$model, $preHandler, $requestHandler, $queryHandler, $commandHandler, $transformationHandler, $responseHandler, $postHandler, $response])
                ->enableOriginalConstructor()
                ->getMockForAbstractClass();

            $this->assertSame($response, $controller->processRequest($request));
        }
    }
}
