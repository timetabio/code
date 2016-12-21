<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Handlers
{
    use Timetabio\Framework\Http\Response\ResponseInterface;
    use Timetabio\Framework\Models\AbstractModel;

    interface ResponseHandlerInterface
    {
        public function execute(ResponseInterface $response, AbstractModel $model);
    }
}
