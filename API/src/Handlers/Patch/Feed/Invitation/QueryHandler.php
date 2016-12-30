<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Patch\Feed\Invitation
{
    use Timetabio\API\Access\AccessControl\FeedAccessControl;
    use Timetabio\API\Exceptions\Forbidden;
    use Timetabio\API\Exceptions\NotFound;
    use Timetabio\API\Models\Feed\User\UpdateModel;
    use Timetabio\API\Queries\Feed\FetchInvitationQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FeedAccessControl
         */
        private $accessControl;

        /**
         * @var FetchInvitationQuery
         */
        private $fetchInvitationQuery;

        public function __construct(FeedAccessControl $accessControl, FetchInvitationQuery $fetchInvitationQuery)
        {
            $this->accessControl = $accessControl;
            $this->fetchInvitationQuery = $fetchInvitationQuery;
        }

        public function execute(AbstractModel $model)
        {
            /** @var UpdateModel $model */

            $feedId = $model->getFeedId();
            $accessToken = $model->getAccessToken();

            if (!$this->accessControl->hasReadAccess($feedId, $accessToken)) {
                throw new NotFound('invitation not found', 'not_found');
            }

            $invitation = $this->fetchInvitationQuery->execute($feedId, $model->getUserId());

            if ($invitation === null) {
                throw new NotFound('invitation not found', 'not_found');
            }

            if (!$this->accessControl->hasWriteAccess($feedId, $accessToken)) {
                throw new Forbidden('access denied', 'access_denied');
            }
        }
    }
}
