<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
