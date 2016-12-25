<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Delete\Feed\People
{
    use Timetabio\API\Access\AccessControl\FeedAccessControl;
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Exceptions\Forbidden;
    use Timetabio\API\Exceptions\NotFound;
    use Timetabio\API\Models\Feed\People\DeleteModel;
    use Timetabio\API\Queries\Feeds\FetchPersonQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchPersonQuery
         */
        private $fetchPersonQuery;

        /**
         * @var FeedAccessControl
         */
        private $accessControl;

        public function __construct(FetchPersonQuery $fetchPersonQuery, FeedAccessControl $accessControl)
        {
            $this->fetchPersonQuery = $fetchPersonQuery;
            $this->accessControl = $accessControl;
        }

        public function execute(AbstractModel $model)
        {
            /** @var DeleteModel $model */

            $feedId = $model->getFeedId();
            $userId = $model->getUserId();
            $accessToken = $model->getAccessToken();

            if (!$this->accessControl->hasReadAccess($feedId, $accessToken)) {
                throw new NotFound('feed not found', 'not_found');
            }

            if (!$this->accessControl->hasWriteAccess($feedId, $accessToken)) {
                throw new Forbidden('access denied', 'access_denied');
            }

            $person = $this->fetchPersonQuery->execute($feedId, $userId);

            if ($person === null) {
                throw new NotFound('feed user not found', 'not_found');
            }

            if (!$this->accessControl->canModifyFeedUser($feedId, $userId, $accessToken)) {
                throw new BadRequest('feed user cannot be deleted', 'delete_error');
            }
        }
    }
}
