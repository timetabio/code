<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Delete\Collection
{
    use Timetabio\API\Models\Collection\CollectionModel;
    use Timetabio\API\ValueObjects\CollectionId;
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class RequestHandler implements RequestHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var CollectionModel $model */

            $path = $request->getUri()->getExplodedPath();
            $model->setCollectionId(new CollectionId($path[2]));
        }
    }
}
