<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Delete\Feed\People
{
    use Timetabio\API\Models\Feed\People\DeleteModel;
    use Timetabio\API\ValueObjects\FeedId;
    use Timetabio\API\ValueObjects\UserId;
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class RequestHandler implements RequestHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var DeleteModel $model */

            $parts = $request->getUri()->getExplodedPath();

            $model->setFeedId(new FeedId($parts[2]));
            $model->setUserId(new UserId($parts[4]));
        }
    }
}
