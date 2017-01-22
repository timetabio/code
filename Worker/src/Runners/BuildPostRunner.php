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
    use Timetabio\Framework\Backends\InkBackend;
    use Timetabio\Library\Tasks\BuildPostTask;
    use Timetabio\Library\Tasks\TaskInterface;
    use Timetabio\Worker\DataStore\DataStoreWriter;
    use Timetabio\Worker\Services\PostService;

    class BuildPostRunner implements RunnerInterface
    {
        /**
         * @var PostService
         */
        private $postService;

        /**
         * @var InkBackend
         */
        private $inkBackend;

        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        public function __construct(PostService $postService, InkBackend $inkBackend, DataStoreWriter $dataStoreWriter)
        {
            $this->postService = $postService;
            $this->inkBackend = $inkBackend;
            $this->dataStoreWriter = $dataStoreWriter;
        }

        public function run(TaskInterface $task)
        {
            if (!$task instanceof BuildPostTask) {
                return;
            }

            $post = $this->postService->getPostBody($task->getPostId());

            if ($post === null) {
                return;
            }

            $rendered = $this->inkBackend->process($post['body']);

            $this->dataStoreWriter->setPostBody($post['id'], $rendered->getBody());
            $this->dataStoreWriter->setPostText($post['id'], $rendered->getPlainText());
        }
    }
}
