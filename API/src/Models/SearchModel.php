<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
