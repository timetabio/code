<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
