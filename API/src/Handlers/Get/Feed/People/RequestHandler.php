<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Get\Feed\People
{
    use Timetabio\API\Models\Feed\People\ListModel;
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class RequestHandler implements RequestHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var ListModel $model */

            $parts = $request->getUri()->getExplodedPath();

            $model->setFeedId($parts[2]);
        }
    }
}
