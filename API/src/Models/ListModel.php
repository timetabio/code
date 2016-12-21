<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Models
{
    class ListModel extends APIModel
    {
        /**
         * @var int
         */
        private $limit = 20;

        /**
         * @var int
         */
        private $page = 1;

        public function getLimit(): int
        {
            return $this->limit;
        }

        public function setLimit(int $limit)
        {
            $this->limit = $limit;
        }

        public function getPage(): int
        {
            return $this->page;
        }

        public function setPage(int $page)
        {
            $this->page = $page;
        }
    }
}
