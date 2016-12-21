<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Worker\Runners
{
    use Timetabio\Library\Locators\UserRoleLocator;
    use Timetabio\Library\Tasks\BuildFeedTask;
    use Timetabio\Library\Tasks\TaskInterface;
    use Timetabio\Worker\DataStore\DataStoreWriter;
    use Timetabio\Worker\Services\FeedService;

    class BuildFeedRunner implements RunnerInterface
    {
        /**
         * @var FeedService
         */
        private $feedService;

        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        /**
         * @var UserRoleLocator
         */
        private $userRoleLocator;

        public function __construct(FeedService $feedService, DataStoreWriter $dataStoreWriter, UserRoleLocator $userRoleLocator)
        {
            $this->feedService = $feedService;
            $this->dataStoreWriter = $dataStoreWriter;
            $this->userRoleLocator = $userRoleLocator;
        }

        public function run(TaskInterface $task)
        {
            if (!$task instanceof BuildFeedTask) {
                return;
            }

            $feedId = $task->getFeedId();
            $feed = $this->feedService->getFullFeed($feedId);

            if ($feed === null) {
                return;
            }

            $this->dataStoreWriter->addFeed($feedId);

            if ($feed['is_private']) {
                $this->dataStoreWriter->addPrivateFeed($feedId);
            }

            if (isset($feed['vanity_name']) && !empty($feed['vanity_name'])) {
                $this->dataStoreWriter->setVanity($feedId, $feed['vanity_name']);
            }

            $users = $this->feedService->getFeedUsers($feedId);

            foreach ($users as $user) {
                $userRole = $this->userRoleLocator->locate($user['role']);

                $this->dataStoreWriter->setFeedAccess($feedId, $user['user_id'], $userRole);
            }
        }
    }
}
