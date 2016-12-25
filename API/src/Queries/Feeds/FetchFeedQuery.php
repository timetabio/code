<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Queries\Feeds
{
    use Timetabio\API\Services\FeedService;
    use Timetabio\API\ValueObjects\FeedId;
    use Timetabio\API\ValueObjects\UserId;

    class FetchFeedQuery
    {
        /**
         * @var FeedService
         */
        private $feedService;

        public function __construct(FeedService $feedService)
        {
            $this->feedService = $feedService;
        }

        public function execute(FeedId $feedId, UserId $userId = null)
        {
            if ($userId === null) {
                return $this->feedService->getFeedById($feedId);
            }

            return $this->feedService->getFeedByIdForUser($feedId, $userId);
        }
    }
}
