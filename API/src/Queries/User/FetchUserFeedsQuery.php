<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Queries\User
{
    use Timetabio\API\Backends\SearchBackend;

    class FetchUserFeedsQuery
    {
        /**
         * @var SearchBackend
         */
        private $searchBackend;

        public function __construct(SearchBackend $searchBackend)
        {
            $this->searchBackend = $searchBackend;
        }

        public function execute(string $userId, int $limit, int $page = 1): array
        {
            return $this->searchBackend->getUserFeeds($userId, $limit, $page);
        }
    }
}
