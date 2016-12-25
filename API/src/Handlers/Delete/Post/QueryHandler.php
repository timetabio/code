<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Delete\Post
{
    use Timetabio\API\Access\AccessControl\FeedAccessControl;
    use Timetabio\API\Exceptions\NotFound;
    use Timetabio\API\Models\Post\PostModel;
    use Timetabio\API\Queries\Post\FetchPostInfoQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchPostInfoQuery
         */
        private $fetchPostInfoQuery;

        /**
         * @var FeedAccessControl
         */
        private $accessControl;

        public function __construct(FetchPostInfoQuery $fetchPostInfoQuery, FeedAccessControl $accessControl)
        {
            $this->fetchPostInfoQuery = $fetchPostInfoQuery;
            $this->accessControl = $accessControl;
        }

        public function execute(AbstractModel $model)
        {
            /** @var PostModel $model */

            $post = $this->fetchPostInfoQuery->execute($model->getPostId());

            // TODO: change access control

            if ($post === null || !$this->accessControl->hasPostAccess($post['feed_id'], $model->getAccessToken())) {
                throw new NotFound('post not found', 'not_found');
            }
        }
    }
}
