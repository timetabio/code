<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Models\Post
{
    use Timetabio\API\Models\APIModel;

    class PostModel extends APIModel
    {
        /**
         * @var string
         */
        private $postId;

        public function getPostId(): string
        {
            return $this->postId;
        }

        public function setPostId(string $postId)
        {
            $this->postId = $postId;
        }
    }
}
