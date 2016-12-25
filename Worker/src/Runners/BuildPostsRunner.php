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
    use Timetabio\Library\Tasks\BuildPostsTask;
    use Timetabio\Library\Tasks\TaskInterface;
    use Timetabio\Worker\DataStore\DataStoreWriter;
    use Timetabio\Worker\Services\PostService;

    class BuildPostsRunner implements RunnerInterface
    {
        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        /**
         * @var PostService
         */
        private $postService;

        public function __construct(DataStoreWriter $dataStoreWriter, PostService $postService)
        {
            $this->dataStoreWriter = $dataStoreWriter;
            $this->postService = $postService;
        }

        public function run(TaskInterface $task)
        {
            if (!$task instanceof BuildPostsTask) {
                return;
            }

            $posts = $this->postService->getPostIds();

            foreach ($posts as $post) {
                $priority = new \Timetabio\Library\TaskPriorities\Random(7200);

                $this->dataStoreWriter->queueTask(
                    new \Timetabio\Library\Tasks\BuildPostTask($post, $priority)
                );
            }
        }
    }
}
