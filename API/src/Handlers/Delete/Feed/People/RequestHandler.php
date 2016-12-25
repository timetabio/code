<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
