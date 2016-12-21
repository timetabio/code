<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Queries\Posts
{
    use Timetabio\API\Backends\SearchBackend;

    class FetchFeedPostsQuery
    {
        /**
         * @var SearchBackend
         */
        private $searchBackend;

        public function __construct(SearchBackend $searchBackend)
        {
            $this->searchBackend = $searchBackend;
        }

        public function execute(string $feedId, int $limit, int $page, string $userId = null)
        {
            return $this->searchBackend->getFeedPosts($feedId, $limit, $page);
        }
    }
}
