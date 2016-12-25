<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers\Get\FeedPeoplePage
{
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Queries\Feed\FetchFeedInvitationsQuery;
    use Timetabio\Frontend\Queries\Feed\FetchFeedUsersQuery;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchFeedUsersQuery
         */
        private $fetchFeedUsersQuery;

        /**
         * @var FetchFeedInvitationsQuery
         */
        private $fetchFeedInvitationsQuery;

        public function __construct(
            FetchFeedUsersQuery $fetchFeedUsersQuery,
            FetchFeedInvitationsQuery $fetchFeedInvitationsQuery
        )
        {
            $this->fetchFeedUsersQuery = $fetchFeedUsersQuery;
            $this->fetchFeedInvitationsQuery = $fetchFeedInvitationsQuery;
        }

        public function execute(AbstractModel $model)
        {
            /** @var \Timetabio\Frontend\Models\Page\FeedPeoplePageModel $model */

            $feed = $model->getFeed();
            $feedId = $feed->getId();

            if ($feed->hasUsersManageAccess()) {
                $model->setFeedInvitations(
                    $this->fetchFeedInvitationsQuery->execute($feedId)
                );
            }

            $users = $this->fetchFeedUsersQuery->execute($feedId);

            if ($users !== null) {
                $model->setFeedUsers($users);
            }

            $model->setTitle($feed->getName());
        }
    }
}
