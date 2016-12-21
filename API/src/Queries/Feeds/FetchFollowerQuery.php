<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Queries\Feeds
{
    use Timetabio\API\Services\FollowerService;
    use Timetabio\API\ValueObjects\FeedId;
    use Timetabio\API\ValueObjects\UserId;

    class FetchFollowerQuery
    {
        /**
         * @var FollowerService
         */
        private $followerService;

        public function __construct(FollowerService $followerService)
        {
            $this->followerService = $followerService;
        }

        public function execute(FeedId $feedId, UserId $userId)
        {
            return $this->followerService->getFollower($feedId, $userId);
        }
    }
}
