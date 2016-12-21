<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Models\Post
{
    use Timetabio\API\Models\APIModel;
    use Timetabio\API\ValueObjects\Attachment;
    use Timetabio\Framework\ValueObjects\Timestamp;
    use Timetabio\Library\PostTypes\PostTypeInterface;

    class CreateModel extends APIModel
    {
        /**
         * @var PostTypeInterface
         */
        private $postType;

        /**
         * @var string
         */
        private $postTitle;

        /**
         * @var string
         */
        private $postBody;

        /**
         * @var string
         */
        private $feedId;

        /**
         * @var Timestamp
         */
        private $postTimestamp;

        /**
         * @var Attachment[]
         */
        private $postAttachments = [];

        public function getPostType(): PostTypeInterface
        {
            return $this->postType;
        }

        public function setPostType(PostTypeInterface $postType)
        {
            $this->postType = $postType;
        }

        public function getPostTitle(): string
        {
            return $this->postTitle;
        }

        public function setPostTitle(string $postTitle)
        {
            $this->postTitle = $postTitle;
        }

        public function getPostBody(): string
        {
            return $this->postBody;
        }

        public function setPostBody(string $postBody)
        {
            $this->postBody = $postBody;
        }

        public function getFeedId(): string
        {
            return $this->feedId;
        }

        public function setFeedId(string $feedId)
        {
            $this->feedId = $feedId;
        }

        public function getPostTimestamp()
        {
            return $this->postTimestamp;
        }

        public function setPostTimestamp(Timestamp $postTimestamp)
        {
            $this->postTimestamp = $postTimestamp;
        }

        public function addPostAttachment(Attachment $attachment)
        {
            $this->postAttachments[] = $attachment;
        }

        public function getPostAttachments(): array
        {
            return $this->postAttachments;
        }
    }
}
