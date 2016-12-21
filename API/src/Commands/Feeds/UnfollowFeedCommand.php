<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Commands\Feeds
{
    use Timetabio\API\DataStore\DataStoreWriter;
    use Timetabio\API\Services\FollowerService;
    use Timetabio\API\ValueObjects\FeedId;
    use Timetabio\API\ValueObjects\UserId;
    use Timetabio\Library\Tasks\IndexUserTask;

    class UnfollowFeedCommand
    {
        /**
         * @var FollowerService
         */
        private $followerService;

        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        public function __construct(FollowerService $followerService, DataStoreWriter $dataStoreWriter)
        {
            $this->followerService = $followerService;
            $this->dataStoreWriter = $dataStoreWriter;
        }

        public function execute(FeedId $feedId, UserId $userId)
        {
            $this->followerService->unfollowFeed($feedId, $userId);
            $this->dataStoreWriter->removeFeedAccess($feedId, $userId);
            $this->dataStoreWriter->queueTask(new IndexUserTask($userId));
        }
    }
}
