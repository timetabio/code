<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Post\Feed\Unfollow
{
    use Timetabio\API\Access\AccessControl\FeedAccessControl;
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Exceptions\NotFound;
    use Timetabio\API\Models\Feed\FollowModel;
    use Timetabio\API\Queries\Feeds\FetchFollowerQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchFollowerQuery
         */
        private $fetchFollowerQuery;

        /**
         * @var FeedAccessControl
         */
        private $accessControl;

        public function __construct(FetchFollowerQuery $fetchFollowerQuery, FeedAccessControl $accessControl)
        {
            $this->fetchFollowerQuery = $fetchFollowerQuery;
            $this->accessControl = $accessControl;
        }

        public function execute(AbstractModel $model)
        {
            /** @var FollowModel $model */

            $feedId = $model->getFeedId();
            $token = $model->getAccessToken();
            $userId = $model->getAuthUserId();

            if (!$this->accessControl->hasFollowAccess($feedId, $token)) {
                throw new NotFound('feed not found', 'not_found');
            }

            $follower = $this->fetchFollowerQuery->execute($feedId, $userId);

            if ($follower !== null) {
                $model->setFollowing(true);
            }

            if (!$this->accessControl->canUnfollow($feedId, $token)) {
                throw new BadRequest('cannot unfollow (e.g. last owner in feed)', 'unfollow_error');
            }
        }
    }
}
