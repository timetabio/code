<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Queries\Feeds
{
    use Timetabio\API\Services\FeedService;
    use Timetabio\API\ValueObjects\FeedId;
    use Timetabio\API\ValueObjects\UserId;

    class FetchFeedQuery
    {
        /**
         * @var FeedService
         */
        private $feedService;

        public function __construct(FeedService $feedService)
        {
            $this->feedService = $feedService;
        }

        public function execute(FeedId $feedId, UserId $userId = null)
        {
            if ($userId === null) {
                return $this->feedService->getFeedById($feedId);
            }

            return $this->feedService->getFeedByIdForUser($feedId, $userId);
        }
    }
}
