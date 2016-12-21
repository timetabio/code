<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers
{
    use Timetabio\API\Models\APIModel;
    use Timetabio\Framework\Handlers\ResponseHandlerInterface;
    use Timetabio\Framework\Http\Response\ResponseInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class ResponseHandler implements ResponseHandlerInterface
    {
        public function execute(ResponseInterface $response, AbstractModel $model)
        {
            /** @var APIModel $model */

            if ($model->hasStatusCode()) {
                $response->setStatusCode($model->getStatusCode());
            }
        }
    }
}
