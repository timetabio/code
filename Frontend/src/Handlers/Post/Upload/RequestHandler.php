<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers\Post\Upload
{
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\PostRequest;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Exceptions\BadRequest;
    use Timetabio\Frontend\Models\Action\UploadModel;

    class RequestHandler implements RequestHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var PostRequest $request */
            /** @var UploadModel $model */

            try {
                $model->setFilename($request->getParam('filename'));
                $model->setMimeType($request->getParam('mime_type'));
            } catch (\Exception $exception) {
                throw new BadRequest('missing parameters');
            }
        }
    }
}
