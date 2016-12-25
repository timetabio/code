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
