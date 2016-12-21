<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\ValueObjects
{
    class PaginatedResult implements \IteratorAggregate
    {
        /**
         * @var array
         */
        private $results = [];

        /**
         * @var int
         */
        private $limit = 20;

        /**
         * @var int
         */
        private $page = 1;

        /**
         * @var int
         */
        private $total = 0;

        /**
         * @var int
         */
        private $pages = 1;

        public function __construct(array $data)
        {
            if (isset($data['results'])) {
                $this->results = $data['results'];
            }

            if (isset($data['filter']['limit'])) {
                $this->limit = $data['filter']['limit'];
            }

            if (isset($data['filter']['page'])) {
                $this->page = $data['filter']['page'];
            }

            if (isset($data['meta']['total'])) {
                $this->total = $data['meta']['total'];
            }

            if (isset($data['meta']['pages'])) {
                $this->pages = $data['meta']['pages'];
            }
        }

        public function getResults(): array
        {
            return $this->results;
        }

        public function getLimit(): int
        {
            return $this->limit;
        }

        public function getPage(): int
        {
            return $this->page;
        }

        public function getPages(): int
        {
            return $this->pages;
        }

        public function getTotal(): int
        {
            return $this->total;
        }

        public function getIterator(): \Iterator
        {
            return new \ArrayIterator($this->results);
        }
    }
}
