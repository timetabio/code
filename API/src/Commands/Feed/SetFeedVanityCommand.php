<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Commands\Feed
{
    use Timetabio\API\DataStore\DataStoreWriter;
    use Timetabio\API\Services\FeedService;

    class SetFeedVanityCommand
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

        public function execute(string $feedId, string $vanity)
        {
            $this->dataStoreWriter->removeVanity($feedId);

            if ($vanity === '') {
                $this->feedService->deleteFeedVanity($feedId);
                return;
            }

            $this->feedService->createFeedVanity($feedId, $vanity);
            $this->dataStoreWriter->setVanity($feedId, $vanity);
        }
    }
}
