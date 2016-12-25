<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Get\Feed
{
    use Timetabio\API\Access\AccessControl\FeedAccessControl;
    use Timetabio\API\Exceptions\NotFound;
    use Timetabio\API\Models\Feed\FeedModel;
    use Timetabio\API\Queries\Feed\FetchFeedVanityQuery;
    use Timetabio\API\Queries\Feed\FetchVanityByNameQuery;
    use Timetabio\API\Queries\Feed\InvitationExistsQuery;
    use Timetabio\API\Queries\Feeds\FetchFeedQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Library\Mappers\FeedMapper;

    /**
     * @todo refactor
     */
    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchFeedQuery
         */
        private $fetchFeedQuery;

        /**
         * @var FetchFeedVanityQuery
         */
        private $fetchFeedVanityQuery;

        /**
         * @var InvitationExistsQuery
         */
        private $invitationExistsQuery;

        /**
         * @var FeedMapper
         */
        private $feedMapper;

        /**
         * @var FeedAccessControl
         */
        private $accessCheck;

        public function __construct(
            FetchFeedQuery $fetchFeedQuery,
            FetchFeedVanityQuery $fetchFeedVanityQuery,
            InvitationExistsQuery $invitationExistsQuery,
            FeedMapper $feedMapper,
            FeedAccessControl $accessCheck
        )
        {
            $this->fetchFeedQuery = $fetchFeedQuery;
            $this->fetchFeedVanityQuery = $fetchFeedVanityQuery;
            $this->invitationExistsQuery = $invitationExistsQuery;
            $this->feedMapper = $feedMapper;
            $this->accessCheck = $accessCheck;
        }

        public function execute(AbstractModel $model)
        {
            /** @var FeedModel $model */

            $feedId = $model->getFeedId();
            $userId = null;
            $token = null;

            if ($model->hasAuthUserId()) {
                $userId = $model->getAuthUserId();
            }

            if ($model->hasAccessToken()) {
                $token = $model->getAccessToken();
            }

            $isInvited = false;

            if ($userId !== null) {
                $isInvited = $this->invitationExistsQuery->execute($feedId, $userId);
            }

            $hasReadAccess = ($this->accessCheck->hasReadAccess($feedId, $token) || $isInvited);

            if (!$hasReadAccess) {
                throw new NotFound('feed not found', 'not_found');
            }

            $feed = $this->fetchFeedQuery->execute($feedId, $userId);
            $hasWriteAccess = $this->accessCheck->hasWriteAccess($feedId, $token);

            $feed['vanity'] = $this->fetchFeedVanityQuery->execute($feedId);
            $feed['access']['post'] = $this->accessCheck->hasPostAccess($feedId, $token);
            $feed['access']['manage_users'] = $hasWriteAccess;

            if ($userId !== null) {
                $feed['user']['invited'] = $isInvited;
            }

            $model->setData($this->feedMapper->map($feed));
        }
    }
}
