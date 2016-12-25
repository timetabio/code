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
    use Timetabio\Library\Tasks\IndexUserTask;
    use Timetabio\Library\Tasks\TaskInterface;
    use Timetabio\Worker\Services\UserService;

    class IndexUserRunner implements RunnerInterface
    {
        /**
         * @var UserService
         */
        private $userService;

        /**
         * @var Indexer
         */
        private $indexer;

        public function __construct(UserService $userService, Indexer $indexer)
        {
            $this->userService = $userService;
            $this->indexer = $indexer;
        }

        public function run(TaskInterface $task)
        {
            if (!($task instanceof IndexUserTask)) {
                return;
            }

            $userId = $task->getUserId();
            $feeds = iterator_to_array($this->userService->getUserFeeds($userId));

            $this->indexer->indexDocument($userId, [
                'feeds' => $feeds
            ]);
        }
    }
}
