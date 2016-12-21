<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\ValueObjects
{
    class Pagination implements \JsonSerializable
    {
        /**
         * @var int
         */
        private $limit;

        /**
         * @var int
         */
        private $page;

        /**
         * @var int
         */
        private $total;

        /**
         * @var array
         */
        private $results;

        public function __construct(int $limit, int $page, int $total, array $results)
        {
            $this->limit = $limit;
            $this->page = $page;
            $this->total = $total;
            $this->results = $results;
        }

        public function jsonSerialize(): array
        {
            return [
                'filter' => [
                    'limit' => $this->limit,
                    'page' => $this->page,
                ],
                'meta' => [
                    'total' => $this->total,
                    'pages' => ceil($this->total / $this->limit)
                ],
                'results' => $this->results
            ];
        }
    }
}
