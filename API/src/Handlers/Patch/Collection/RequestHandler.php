<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Patch\Collection
{
    use Timetabio\API\Models\Collection\UpdateModel;
    use Timetabio\API\ValueObjects\CollectionId;
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\PatchRequest;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class RequestHandler implements RequestHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var PatchRequest $request */
            /** @var UpdateModel $model */

            $parts = $request->getUri()->getExplodedPath();

            $model->setCollectionId(new CollectionId($parts[2]));

            if ($request->hasParam('name')) {
                $model->addUpdate('name', $request->getParam('name'));
            }
        }
    }
}
