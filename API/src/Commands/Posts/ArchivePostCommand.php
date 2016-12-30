<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Commands\Posts
{
    use Timetabio\API\DataStore\DataStoreWriter;
    use Timetabio\API\Services\PostService;

    class ArchivePostCommand
    {
        /**
         * @var PostService
         */
        private $postService;

        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        public function __construct(PostService $postService, DataStoreWriter $dataStoreWriter)
        {
            $this->postService = $postService;
            $this->dataStoreWriter = $dataStoreWriter;
        }

        public function execute(string $postId): string
        {
            $archived = $this->postService->archivePost($postId);

            $this->dataStoreWriter->queueTask(new \Timetabio\Library\Tasks\IndexPostTask($postId));

            return $archived;
        }
    }
}
