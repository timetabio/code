<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Handlers\Post\CreateNote
{
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\PostRequest;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Exceptions\BadRequest;
    use Timetabio\Frontend\Models\Action\CreateNoteModel;

    class RequestHandler implements RequestHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var PostRequest $request */
            /** @var CreateNoteModel $model */

            try {
                $model->setFeedId($request->getParam('feed_id'));
                $model->setPostTitle($request->getParam('title'));
                $model->setPostBody($request->getParam('body'));
            } catch (\Exception $exception) {
                throw new BadRequest('missing fields');
            }

            if (!$request->hasParam('attachments')) {
                return;
            }

            $attachments = $request->getParam('attachments');

            if (!is_array($attachments)) {
                return;
            }

            foreach ($attachments as $attachment) {
                $model->addAttachment($attachment);
            }
        }
    }
}
