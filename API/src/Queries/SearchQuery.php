<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
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
