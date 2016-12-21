<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Commands\Feed
{
    use Timetabio\API\DataStore\DataStoreWriter;
    use Timetabio\API\Services\FeedService;
    use Timetabio\Library\UserRoles\UserRole;

    class UpdateFeedUserCommand
    {
        /**
         * @var FeedService
         */
        private $feedService;

        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        public function __construct(FeedService $feedService, DataStoreWriter $dataStoreWriter)
        {
            $this->feedService = $feedService;
            $this->dataStoreWriter = $dataStoreWriter;
        }

        public function execute(string $feedId, string $userId, UserRole $role)
        {
            $this->feedService->updateFeedUser($feedId, $userId, $role);

            $this->dataStoreWriter->removeFeedAccess($feedId, $userId);
            $this->dataStoreWriter->setFeedAccess($feedId, $userId, $role);
        }
    }
}
