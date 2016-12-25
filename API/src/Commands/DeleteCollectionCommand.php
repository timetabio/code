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
    use Timetabio\API\Services\CollectionService;
    use Timetabio\API\ValueObjects\CollectionId;

    class DeleteCollectionCommand
    {
        /**
         * @var CollectionService
         */
        private $collectionService;

        public function __construct(CollectionService $collectionService)
        {
            $this->collectionService = $collectionService;
        }

        public function execute(CollectionId $collectionId)
        {
            $this->collectionService->deleteCollection($collectionId);
        }
    }
}
