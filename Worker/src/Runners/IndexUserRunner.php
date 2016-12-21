<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
