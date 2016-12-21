<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Models\Action
{
    use Timetabio\Frontend\Models\ActionModel;

    class DeletePostModel extends ActionModel
    {
        /**
         * @var string
         */
        private $postId;

        /**
         * @var string
         */
        private $feedId;

        public function getPostId(): string
        {
            return $this->postId;
        }

        public function setPostId(string $postId)
        {
            $this->postId = $postId;
        }

        public function getFeedId(): string
        {
            return $this->feedId;
        }

        public function setFeedId(string $feedId)
        {
            $this->feedId = $feedId;
        }
    }
}
