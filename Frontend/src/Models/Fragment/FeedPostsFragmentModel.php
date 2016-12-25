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

    class FeedPostsFragmentModel extends FragmentModel
    {
        /**
         * @var string
         */
        private $feedId;

        /**
         * @var int
         */
        private $limit;

        /**
         * @var int
         */
        private $page;

        /**
         * @var array
         */
        private $feed;

        /**
         * @var PaginatedResult
         */
        private $posts;

        public function getFeedId(): string
        {
            return $this->feedId;
        }

        public function setFeedId(string $feedId)
        {
            $this->feedId = $feedId;
        }

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

        public function getFeed(): array
        {
            return $this->feed;
        }

        public function setFeed(array $feed)
        {
            $this->feed = $feed;
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
