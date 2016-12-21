<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Models
{
    use Timetabio\Library\SearchTypes\SearchType;

    class SearchModel extends ListModel
    {
        /**
         * @var string
         */
        private $query;

        /**
         * @var SearchType
         */
        private $type;

        public function __construct()
        {
            $this->type = new \Timetabio\Library\SearchTypes\All;
        }

        public function getQuery(): string
        {
            return $this->query;
        }

        public function setQuery(string $query)
        {
            $this->query = $query;
        }

        public function getType(): SearchType
        {
            return $this->type;
        }

        public function setType(SearchType $type)
        {
            $this->type = $type;
        }
    }
}
