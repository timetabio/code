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
    use Timetabio\Framework\Backends\ElasticBackend;

    class RestorePostCommand
    {
        /**
         * @var PostService
         */
        private $postService;

        /**
         * @var ElasticBackend
         */
        private $elasticBackend;

        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        public function __construct(PostService $postService, ElasticBackend $elasticBackend, DataStoreWriter $dataStoreWriter)
        {
            $this->postService = $postService;
            $this->elasticBackend = $elasticBackend;
            $this->dataStoreWriter = $dataStoreWriter;
        }

        public function execute(string $postId): void
        {
            $this->postService->restorePost($postId);

            $this->elasticBackend->updateDocument('post', $postId, [
                'archived' => null,
                'meta' => [
                    'delete_timestamp' => null
                ]
            ]);

            $this->dataStoreWriter->queueTask(new \Timetabio\Library\Tasks\IndexPostTask($postId));
        }
    }
}
