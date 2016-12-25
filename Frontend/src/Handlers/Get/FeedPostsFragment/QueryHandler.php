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
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Models\Fragment\FeedPostsFragmentModel;
    use Timetabio\Frontend\Queries\FetchFeedPostsQuery;
    use Timetabio\Frontend\Queries\FetchFeedQuery;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchFeedQuery
         */
        private $fetchFeedQuery;

        /**
         * @var FetchFeedPostsQuery
         */
        private $fetchFeedPostsQuery;

        public function __construct(FetchFeedQuery $fetchFeedQuery, FetchFeedPostsQuery $fetchFeedPostsQuery)
        {
            $this->fetchFeedQuery = $fetchFeedQuery;
            $this->fetchFeedPostsQuery = $fetchFeedPostsQuery;
        }

        public function execute(AbstractModel $model)
        {
            /** @var FeedPostsFragmentModel $model */

            $model->setFeed($this->fetchFeedQuery->execute(
                $model->getFeedId()
            ));

            $model->setPosts($this->fetchFeedPostsQuery->execute(
                $model->getFeedId(),
                $model->getLimit(),
                $model->getPage()
            ));
        }
    }
}
