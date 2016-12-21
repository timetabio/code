<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Queries\User
{
    use Timetabio\API\Backends\SearchBackend;

    class FetchUserFeedQuery
    {
        /**
         * @var SearchBackend
         */
        private $searchBackend;

        public function __construct(SearchBackend $searchBackend)
        {
            $this->searchBackend = $searchBackend;
        }

        public function execute(string $userId, int $limit, int $page): array
        {
            return $this->searchBackend->getUserFeed($userId, $limit, $page);
        }
    }
}
