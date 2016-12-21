<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Get\Feed\Posts
{
    use Timetabio\API\Handlers\Get\ListRequestHandler;
    use Timetabio\API\Models\Feed\Posts\ListModel;
    use Timetabio\API\ValueObjects\FeedId;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class RequestHandler extends ListRequestHandler
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var ListModel $model */
            parent::execute($request, $model);

            $parts = $request->getUri()->getExplodedPath();
            $feedId = new FeedId($parts[2]);

            $model->setFeedId($feedId);
        }
    }
}
