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
    use Timetabio\Library\Tasks\DeleteArchivedPostsTask;
    use Timetabio\Library\Tasks\TaskInterface;
    use Timetabio\Worker\DataStore\DataStoreWriter;
    use Timetabio\Worker\Services\PostService;

    class DeleteArchivedPostsRunner implements RunnerInterface
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

        public function run(TaskInterface $task)
        {
            if (!$task instanceof DeleteArchivedPostsTask) {
                return;
            }

            $posts = $this->postService->deleteExpiredArchivedPosts();

            foreach($posts as $post) {
                $this->dataStoreWriter->removePostBody($post);
                $this->dataStoreWriter->removePostPreview($post);
                $this->dataStoreWriter->removePostText($post);
                $this->dataStoreWriter->queueTask(new \Timetabio\Library\Tasks\IndexPostTask($post));
            }
        }
    }
}
