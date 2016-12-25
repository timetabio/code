<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
