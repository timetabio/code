<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers\Get\HomepagePostsFragment
{
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Models\Fragment\HomepagePostsFragmentModel;
    use Timetabio\Frontend\Queries\FetchUserFeedQuery;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchUserFeedQuery
         */
        private $fetchUserFeedQuery;

        public function __construct(FetchUserFeedQuery $fetchUserFeedQuery)
        {
            $this->fetchUserFeedQuery = $fetchUserFeedQuery;
        }

        public function execute(AbstractModel $model)
        {
            /** @var HomepagePostsFragmentModel $model */

            $model->setPosts($this->fetchUserFeedQuery->execute(
                $model->getLimit(),
                $model->getPage()
            ));
        }
    }
}
