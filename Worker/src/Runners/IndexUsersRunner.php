<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
