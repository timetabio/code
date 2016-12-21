<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Get\Feed
{
    use Timetabio\API\Models\Feed\FeedModel;
    use Timetabio\API\ValueObjects\FeedId;
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class RequestHandler implements RequestHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var FeedModel $model */

            $path = $request->getUri()->getExplodedPath();
            $feedId = new FeedId($path[2]);

            $model->setFeedId($feedId);
        }
    }
}
