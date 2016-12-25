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
    use Timetabio\API\Services\FollowerService;
    use Timetabio\API\ValueObjects\FeedId;
    use Timetabio\API\ValueObjects\UserId;

    class FetchFollowerQuery
    {
        /**
         * @var FollowerService
         */
        private $followerService;

        public function __construct(FollowerService $followerService)
        {
            $this->followerService = $followerService;
        }

        public function execute(FeedId $feedId, UserId $userId)
        {
            return $this->followerService->getFollower($feedId, $userId);
        }
    }
}
