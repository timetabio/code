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
    use Timetabio\Library\Tasks\IndexUsersTask;
    use Timetabio\Library\Tasks\TaskInterface;
    use Timetabio\Worker\DataStore\DataStoreWriter;
    use Timetabio\Worker\Services\UserService;

    class IndexUsersRunner implements RunnerInterface
    {
        /**
         * @var UserService
         */
        private $userService;

        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        public function __construct(UserService $userService, DataStoreWriter $dataStoreWriter)
        {
            $this->userService = $userService;
            $this->dataStoreWriter = $dataStoreWriter;
        }

        public function run(TaskInterface $task)
        {
            if (!($task instanceof IndexUsersTask)) {
                return;
            }

            foreach ($this->userService->getUserIds() as $user) {
                $this->dataStoreWriter->queueTask(new \Timetabio\Library\Tasks\IndexUserTask($user));
            }
        }
    }
}
