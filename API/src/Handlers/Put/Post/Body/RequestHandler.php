<?php
/**
 * Copyright (c) 2017 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Put\Post\Body
{
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\Post\UpdateBodyModel;
    use Timetabio\API\ValueObjects\PostBody;
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\PutRequest;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class RequestHandler implements RequestHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var PutRequest $request */
            /** @var UpdateBodyModel $model */

            if (!$request->hasParam('body')) {
                throw new BadRequest('missing parameter \'body\'', 'missing_parameter');
            }

            try {
                $body = new PostBody($request->getParam('body'));
            } catch (\Exception $exception) {
                throw new BadRequest($exception->getMessage(), 'invalid_body');
            }

            $model->setPostBody($body);
        }
    }
}
