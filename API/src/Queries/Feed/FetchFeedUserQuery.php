<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Queries\Feed
{
    use Timetabio\API\Services\PeopleService;

    class FetchFeedUserQuery
    {
        /**
         * @var PeopleService
         */
        private $peopleService;

        public function __construct(PeopleService $peopleService)
        {
            $this->peopleService = $peopleService;
        }

        public function execute(string $feedId, string $userId)
        {
            return $this->peopleService->getPerson($feedId, $userId);
        }
    }
}
