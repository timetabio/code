<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers\Get\FeedPostsFragment
{
    use Timetabio\Framework\Handlers\RequestHandlerInterface;
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Models\Fragment\FeedPostsFragmentModel;

    class RequestHandler implements RequestHandlerInterface
    {
        public function execute(RequestInterface $request, AbstractModel $model)
        {
            /** @var FeedPostsFragmentModel $model */

            $parts = $request->getUri()->getExplodedPath();

            $model->setFeedId($parts[2]);

            try {
                $limit = (int) $request->getQueryParam('limit');
            } catch (\Throwable $exception) {
                $limit = 20;
            }

            try {
                $page = (int) $request->getQueryParam('page');
            } catch (\Throwable $exception) {
                $page = 1;
            }

            $model->setLimit($limit);
            $model->setPage($page);
        }
    }
}
