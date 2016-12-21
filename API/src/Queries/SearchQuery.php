<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Queries
{
    use Timetabio\API\Backends\SearchBackend;
    use Timetabio\Library\SearchTypes\SearchType;

    class SearchQuery
    {
        /**
         * @var SearchBackend
         */
        private $searchBackend;

        public function __construct(SearchBackend $searchBackend)
        {
            $this->searchBackend = $searchBackend;
        }

        public function execute(string $query, SearchType $type, string $userId, int $limit, int $page): array
        {
            return $this->searchBackend->search($query, $type, $userId, $limit, $page);
        }
    }
}
