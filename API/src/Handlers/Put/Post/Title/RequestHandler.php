<?php
/**
 * Copyright (c) 2017 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Put\Post\Title
{
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\Post\UpdateTitleModel;
    use Timetabio\API\ValueObjects\PostTitle;
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\PutRequest;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class RequestHandler implements RequestHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var PutRequest $request */
            /** @var UpdateTitleModel $model */

            if (!$request->hasParam('title')) {
                throw new BadRequest('missing parameter \'title\'', 'missing_parameter');
            }

            try {
                $body = new PostTitle($request->getParam('title'));
            } catch (\Exception $exception) {
                throw new BadRequest($exception->getMessage(), 'invalid_title');
            }

            $model->setPostTitle($body);
        }
    }
}
