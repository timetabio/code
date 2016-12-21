<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Queries\Feeds
{
    use Timetabio\API\Services\FeedService;

    class FetchFeedsQuery
    {
        /**
         * @var FeedService
         */
        private $feedService;

        public function __construct(FeedService $feedService)
        {
            $this->feedService = $feedService;
        }

        public function execute(int $limit, int $page = 1): array
        {
            return $this->feedService->getPublicFeeds($limit, $page);
        }
    }
}
