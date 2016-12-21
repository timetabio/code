<?php
/**
 * (c) 2016 Ruben Schmidmeister
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

    abstract class AbstractController implements ControllerInterface
    {
        /**
         * @var AbstractModel $model
         */
        private $model;

        /**
         * @var PreHandlerInterface $preHandler
         */
        private $preHandler;

        /**
         * @var RequestHandlerInterface
         */
        private $requestHandler;

        /**
         * @var CommandHandlerInterface $commandHandler
         */
        private $commandHandler;

        /**
         * @var QueryHandlerInterface $queryHandler
         */
        private $queryHandler;

        /**
         * @var TransformationHandlerInterface $transformationHandler
         */
        private $transformationHandler;

        /**
         * @var ResponseHandlerInterface $responseHandlerInterface
         */
        private $responseHandlerInterface;

        /**
         * @var PostHandlerInterface $postHandlerInterface
         */
        private $postHandlerInterface;

        /**
         * @var ResponseInterface $response
         */
        private $response;

        public function __construct(
            AbstractModel $model,
            PreHandlerInterface $preHandler,
            RequestHandlerInterface $requestHandler,
            QueryHandlerInterface $queryHandler,
            CommandHandlerInterface $commandHandler,
            TransformationHandlerInterface $transformationHandler,
            ResponseHandlerInterface $responseHandlerInterface,
            PostHandlerInterface $postHandlerInterface,
            ResponseInterface $response
        )
        {
            $this->model = $model;
            $this->preHandler = $preHandler;
            $this->requestHandler = $requestHandler;
            $this->queryHandler = $queryHandler;
            $this->commandHandler = $commandHandler;
            $this->transformationHandler = $transformationHandler;
            $this->responseHandlerInterface = $responseHandlerInterface;
            $this->postHandlerInterface = $postHandlerInterface;
            $this->response = $response;
        }

        public function processRequest(RequestInterface $request): ResponseInterface
        {
            $this->preHandler->execute($request, $this->model);
            $this->requestHandler->execute($request, $this->model);

            $this->queryHandler->execute($this->model);
            $this->commandHandler->execute($this->model);

            $this->response->setBody($this->transformationHandler->execute($this->model));

            $this->responseHandlerInterface->execute($this->response, $this->model);
            $this->postHandlerInterface->execute($this->model);

            return $this->response;
        }
    }
}

