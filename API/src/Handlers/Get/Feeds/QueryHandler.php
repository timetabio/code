<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Get\Feeds
{
    use Timetabio\API\Models\ListModel;
    use Timetabio\API\Queries\Feeds\FetchFeedsQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Library\Mappers\FeedMapper;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchFeedsQuery
         */
        private $fetchFeedsQuery;

        /**
         * @var FeedMapper
         */
        private $feedMapper;

        public function __construct(FetchFeedsQuery $fetchFeedsQuery, FeedMapper $feedMapper)
        {
            $this->fetchFeedsQuery = $fetchFeedsQuery;
            $this->feedMapper = $feedMapper;
        }

        public function execute(AbstractModel $model)
        {
            /** @var ListModel $model */

            $limit = $model->getLimit();
            $page = $model->getPage();

            $feeds = $this->fetchFeedsQuery->execute($limit, $page);

            foreach ($feeds as $i => $feed) {
                $feeds[$i] = $this->feedMapper->map($feed);
            }

            $model->setData([
                'pagination' => [
                    'limit' => $limit,
                    'page' => $page
                ],
                'feeds' => $feeds
            ]);
        }
    }
}
