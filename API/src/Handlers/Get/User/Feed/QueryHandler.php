<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Get\User\Feed
{
    use Timetabio\API\Mappers\ResultsMapper;
    use Timetabio\API\Models\Feed\People\ListModel;
    use Timetabio\API\Queries\User\FetchUserFeedQuery;
    use Timetabio\API\ValueObjects\Pagination;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchUserFeedQuery
         */
        private $fetchUserFeedQuery;

        /**
         * @var ResultsMapper
         */
        private $resultsMapper;

        public function __construct(FetchUserFeedQuery $fetchUserFeedQuery, ResultsMapper $resultsMapper)
        {
            $this->fetchUserFeedQuery = $fetchUserFeedQuery;
            $this->resultsMapper = $resultsMapper;
        }

        public function execute(AbstractModel $model)
        {
            /** @var ListModel $model */

            $limit = $model->getLimit();
            $page = $model->getPage();

            $posts = $this->fetchUserFeedQuery->execute(
                $model->getAuthUserId(),
                $limit,
                $page
            );

            $mapped = $this->resultsMapper->map($posts);

            $model->setData(new Pagination(
                $limit,
                $page,
                $posts['hits']['total'],
                $mapped
            ));
        }
    }
}
