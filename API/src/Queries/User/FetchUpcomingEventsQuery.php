<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Queries\User
{
    use Timetabio\API\Services\PostService;
    use Timetabio\API\ValueObjects\UserId;

    class FetchUpcomingEventsQuery
    {
        /**
         * @var PostService
         */
        private $postService;

        public function __construct(PostService $postService)
        {
            $this->postService = $postService;
        }

        public function execute(UserId $userId, int $limit, int $page): array
        {
            return $this->postService->getUpcomingEvents($userId, $limit, $page);
        }
    }
}
