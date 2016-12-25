<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Patch\Feed
{
    use Timetabio\API\Access\AccessControl\FeedAccessControl;
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Exceptions\Forbidden;
    use Timetabio\API\Exceptions\NotFound;
    use Timetabio\API\Models\Feed\UpdateModel;
    use Timetabio\API\Queries\Feed\FetchVanityByNameQuery;
    use Timetabio\Framework\Handlers\QueryHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class QueryHandler implements QueryHandlerInterface
    {
        /**
         * @var FetchVanityByNameQuery
         */
        private $fetchVanityByNameQuery;

        /**
         * @var FeedAccessControl
         */
        private $accessControl;

        public function __construct(FetchVanityByNameQuery $fetchVanityByNameQuery, FeedAccessControl $accessControl)
        {
            $this->fetchVanityByNameQuery = $fetchVanityByNameQuery;
            $this->accessControl = $accessControl;
        }

        public function execute(AbstractModel $model)
        {
            /** @var UpdateModel $model */

            $token = $model->getAccessToken();
            $feedId = $model->getFeedId();

            if (!$this->accessControl->hasReadAccess($feedId, $token)) {
                throw new NotFound('feed not found', 'not_found');
            }

            if (!$this->accessControl->hasWriteAccess($feedId, $token)) {
                throw new Forbidden('access denied', 'access_denied');
            }

            if ($model->hasFeedVanity()) {
                $this->checkVanity($model);
            }
        }

        private function checkVanity(UpdateModel $model)
        {
            $vanity = $this->fetchVanityByNameQuery->execute($model->getFeedVanity());

            if ($vanity === null || $vanity['feed_id'] === (string) $model->getFeedId()) {
                return;
            }

            throw new BadRequest('vanity already taken', 'vanity_taken');
        }
    }
}
