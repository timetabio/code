<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Get\Feed\Posts
{
    use Timetabio\API\Access\AccessControl\FeedAccessControl;
    use Timetabio\API\Exceptions\NotFound;
    use Timetabio\API\Mappers\ResultsMapper;
    use Timetabio\API\Models\Feed\Posts\ListModel;
    use Timetabio\API\Queries\Posts\FetchFeedPostsQuery;
    use Timetabio\API\ValueObjects\Pagination;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchFeedPostsQuery
         */
        private $fetchFeedPostsQuery;

        /**
         * @var FeedAccessControl
         */
        private $accessControl;

        /**
         * @var ResultsMapper
         */
        private $resultsMapper;

        public function __construct(
            FetchFeedPostsQuery $fetchFeedPostsQuery,
            FeedAccessControl $accessControl,
            ResultsMapper $resultsMapper
        )
        {
            $this->fetchFeedPostsQuery = $fetchFeedPostsQuery;
            $this->accessControl = $accessControl;
            $this->resultsMapper = $resultsMapper;
        }

        public function execute(AbstractModel $model)
        {
            /** @var ListModel $model */

            $feedId = $model->getFeedId();
            $limit = $model->getLimit();
            $page = $model->getPage();

            $accessToken = null;
            $userId = null;

            if ($model->hasAccessToken()) {
                $accessToken = $model->getAccessToken();
            }

            if ($model->hasAuthUserId()) {
                $userId = $model->getAuthUserId();
            }

            if (!$this->accessControl->hasReadAccess($feedId, $accessToken)) {
                throw new NotFound('feed not found', 'not_found');
            }

            $posts = $this->fetchFeedPostsQuery->execute($feedId, $limit, $page, $userId);

            $model->setData(new Pagination(
                $model->getLimit(),
                $model->getPage(),
                $posts['hits']['total'],
                $this->resultsMapper->map($posts)
            ));
        }
    }
}
