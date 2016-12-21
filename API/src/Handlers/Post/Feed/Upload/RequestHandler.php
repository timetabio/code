<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Post\Feed\Upload
{
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\Feed\UploadModel;
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\PostRequest;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class RequestHandler implements RequestHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var UploadModel $model */
            /** @var PostRequest $request */

            if (!$request->hasParam('mime_type')) {
                throw new BadRequest('missing mime type', 'missing_mime_type');
            }

            if (!$request->hasParam('filename')) {
                throw new BadRequest('missing filename', 'missing_filename');
            }

            $model->setFilename($request->getParam('filename'));
            $model->setMimeType($request->getParam('mime_type'));
        }
    }
}
