<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Delete\Feed\Invitation
{
    use Timetabio\API\Models\Feed\Invitation\DeleteModel;
    use Timetabio\API\ValueObjects\FeedId;
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\PostRequest;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class RequestHandler implements RequestHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var PostRequest $request */
            /** @var DeleteModel $model */

            $parts = $request->getUri()->getExplodedPath();

            $model->setFeedId(new FeedId($parts[2]));
            $model->setUserId($parts[4]);
        }
    }
}
