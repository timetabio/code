<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Post\Collections
{
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\Collection\CreateModel;
    use Timetabio\API\ValueObjects\CollectionName;
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\PostRequest;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class RequestHandler implements RequestHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var PostRequest $request */
            /** @var CreateModel $model */

            if (!$request->hasParam('name')) {
                throw new BadRequest('missing parameter \'name\'', 'missing_parameter');
            }

            try {
                $name = new CollectionName($request->getParam('name'));
            } catch (\Exception $e) {
                throw new BadRequest('invalid name', 'invalid_name');
            }

            $model->setCollectionName($name);
        }
    }
}
