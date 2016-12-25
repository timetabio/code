<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Commands\Feeds
{
    use Timetabio\API\DataStore\DataStoreWriter;
    use Timetabio\API\Services\PeopleService;

    class DeleteFeedPersonCommand
    {
        /**
         * @var PeopleService
         */
        private $peopleService;

        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        public function __construct(PeopleService $peopleService, DataStoreWriter $dataStoreWriter)
        {
            $this->peopleService = $peopleService;
            $this->dataStoreWriter = $dataStoreWriter;
        }

        public function execute(string $feedId, string $userId)
        {
            $this->peopleService->deletePerson($feedId, $userId);

            $this->dataStoreWriter->removeFeedAccess($feedId, $userId);

            $this->dataStoreWriter->queueTask(new \Timetabio\Library\Tasks\IndexUserTask($userId));
        }
    }
}
