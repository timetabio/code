<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Commands
{
    use Timetabio\API\DataStore\DataStoreWriter;
    use Timetabio\API\Services\FeedService;
    use Timetabio\API\ValueObjects\UserId;

    class CreateFeedCommand
    {
        /**
         * @var FeedService
         */
        private $feedService;

        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        public function __construct(FeedService $feedService, DataStoreWriter $dataStoreWriter)
        {
            $this->feedService = $feedService;
            $this->dataStoreWriter = $dataStoreWriter;
        }

        public function execute(UserId $owner, string $name, string $description, bool $isPrivate): array
        {
            $feed = $this->feedService->createFeed($owner, $name, $description, $isPrivate);
            $feedId = $feed['id'];

            $this->dataStoreWriter->setFeedAccess($feedId, $owner, new \Timetabio\Library\UserRoles\Owner);

            if ($isPrivate) {
                $this->dataStoreWriter->addPrivateFeed($feedId);
            }

            $this->dataStoreWriter->addFeed($feedId);
            $this->dataStoreWriter->queueTask(new \Timetabio\Library\Tasks\IndexFeedTask($feedId));
            $this->dataStoreWriter->queueTask(new \Timetabio\Library\Tasks\IndexUserTask($owner));

            return $feed;
        }
    }
}
