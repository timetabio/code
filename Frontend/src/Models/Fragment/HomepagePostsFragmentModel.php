<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Models\Fragment
{
    use Timetabio\Frontend\Models\FragmentModel;
    use Timetabio\Frontend\ValueObjects\PaginatedResult;

    class HomepagePostsFragmentModel extends FragmentModel
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
         * @var PaginatedResult
         */
        private $posts;

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

        public function getPosts(): PaginatedResult
        {
            return $this->posts;
        }

        public function setPosts(PaginatedResult $posts)
        {
            $this->posts = $posts;
        }
    }
}
