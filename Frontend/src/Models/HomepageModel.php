<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Models
{
    use Timetabio\Frontend\ValueObjects\PaginatedResult;

    class HomepageModel extends PageModel
    {
        /**
         * @var PaginatedResult
         */
        private $posts;

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
