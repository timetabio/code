<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Patch\Feed\User
{
    use Timetabio\API\Access\AccessControl\FeedAccessControl;
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Exceptions\Forbidden;
    use Timetabio\API\Exceptions\NotFound;
    use Timetabio\API\Models\Feed\User\UpdateModel;
    use Timetabio\API\Queries\Feed\FetchFeedUserQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FeedAccessControl
         */
        private $accessControl;

        /**
         * @var FetchFeedUserQuery
         */
        private $fetchFeedUserQuery;

        public function __construct(FeedAccessControl $accessControl, FetchFeedUserQuery $fetchFeedUserQuery)
        {
            $this->accessControl = $accessControl;
            $this->fetchFeedUserQuery = $fetchFeedUserQuery;
        }

        public function execute(AbstractModel $model)
        {
            /** @var UpdateModel $model */

            $feedId = $model->getFeedId();
            $userId = $model->getUserId();
            $accessToken = $model->getAccessToken();

            if (!$this->accessControl->hasReadAccess($feedId, $accessToken)) {
                throw new NotFound('feed user not found', 'not_found');
            }

            $user = $this->fetchFeedUserQuery->execute($feedId, $userId);

            if ($user === null) {
                throw new NotFound('feed user not found', 'not_found');
            }

            if (!$this->accessControl->hasWriteAccess($feedId, $accessToken)) {
                throw new Forbidden('access denied', 'access_denied');
            }

            if (!$this->accessControl->canModifyFeedUser($feedId, $userId, $accessToken)) {
                throw new BadRequest('feed user cannot be updated', 'update_error');
            }
        }
    }
}
