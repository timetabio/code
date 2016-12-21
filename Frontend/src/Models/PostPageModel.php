<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Models
{
    class PostPageModel extends PageModel
    {
        /**
         * @var array
         */
        private $post;

        public function __construct(array $post)
        {
            $this->post = $post;
        }

        public function getPost(): array
        {
            return $this->post;
        }
    }
}
