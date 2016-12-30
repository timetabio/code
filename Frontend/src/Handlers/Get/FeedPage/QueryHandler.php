<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers\Get\FeedPage
{
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Models\Page\FeedPostsPageModel;
    use Timetabio\Frontend\Queries\FetchFeedPostsQuery;
    use Timetabio\Library\Builders\UriBuilder;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchFeedPostsQuery
         */
        private $fetchFeedPostsQuery;

        /**
         * @var UriBuilder
         */
        private $uriBuilder;

        public function __construct(FetchFeedPostsQuery $fetchFeedPostsQuery, UriBuilder $uriBuilder)
        {
            $this->fetchFeedPostsQuery = $fetchFeedPostsQuery;
            $this->uriBuilder = $uriBuilder;
        }

        public function execute(AbstractModel $model)
        {
            /** @var FeedPostsPageModel $model */

            $feed = $model->getFeed();
            $feedId = $feed->getId();

            $posts = $this->fetchFeedPostsQuery->execute($feedId);

            $model->setFeedPosts($posts);
            $model->setCanonicalUri($this->uriBuilder->buildFeedPageUri($feedId));
        }
    }
}
