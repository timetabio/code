<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Worker\Runners
{
    use Timetabio\Library\Indexers\Indexer;
    use Timetabio\Library\Mappers\PostMapper;
    use Timetabio\Library\Tasks\IndexPostTask;
    use Timetabio\Library\Tasks\TaskInterface;
    use Timetabio\Worker\DataStore\DataStoreReader;
    use Timetabio\Worker\Services\PostService;

    class IndexPostRunner implements RunnerInterface
    {
        /**
         * @var PostService
         */
        private $postService;

        /**
         * @var PostMapper
         */
        private $postMapper;

        /**
         * @var DataStoreReader
         */
        private $dataStoreReader;

        /**
         * @var Indexer
         */
        private $indexer;

        public function __construct(PostService $postService, PostMapper $postMapper, DataStoreReader $dataStoreReader, Indexer $indexer)
        {
            $this->postService = $postService;
            $this->postMapper = $postMapper;
            $this->dataStoreReader = $dataStoreReader;
            $this->indexer = $indexer;
        }

        public function run(TaskInterface $task)
        {
            if (!$task instanceof IndexPostTask) {
                return;
            }

            $postId = $task->getPostId();

            $post = $this->postService->getPost($postId);

            if ($post === null) {
                $this->indexer->deleteDocument($postId);
                return;
            }

            $post['body'] = $this->dataStoreReader->getPostText($postId);
            $post['rendered_body'] = $this->dataStoreReader->getPostBody($postId);

            $mapped = $this->postMapper->map($post);

            $this->indexer->indexDocument($postId, $mapped);
        }
    }
}
