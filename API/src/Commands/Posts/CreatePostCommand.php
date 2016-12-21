<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Commands\Posts
{
    use Timetabio\API\DataStore\DataStoreWriter;
    use Timetabio\API\Services\PostService;
    use Timetabio\API\ValueObjects\Attachment;
    use Timetabio\Framework\Backends\InkBackend;
    use Timetabio\Framework\ValueObjects\Timestamp;
    use Timetabio\Library\PostTypes\PostTypeInterface;

    class CreatePostCommand
    {
        /**
         * @var InkBackend
         */
        private $inkBackend;

        /**
         * @var PostService
         */
        private $postService;

        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        public function __construct(
            InkBackend $inkBackend,
            PostService $postService,
            DataStoreWriter $dataStoreWriter
        )
        {
            $this->inkBackend = $inkBackend;
            $this->postService = $postService;
            $this->dataStoreWriter = $dataStoreWriter;
        }

        public function execute(
            PostTypeInterface $type,
            string $title,
            string $body,
            string $feedId,
            string $authorId,
            Timestamp $timestamp = null,
            array $attachments
        ): array
        {
            $inkResult = $this->inkBackend->process($body);
            $post = $this->postService->createPost($type, $feedId, $authorId, $title, $body, $timestamp);
            $postId = $post['id'];

            /** @var Attachment $attachment */
            foreach ($attachments as $attachment) {
                $this->postService->createAttachment($postId, $attachment);
            }

            $this->dataStoreWriter->setPostBody($postId, $inkResult->getBody());
            $this->dataStoreWriter->setPostPreview($postId, $inkResult->getPreview());
            $this->dataStoreWriter->setPostText($postId, $inkResult->getPlainText());

            $this->dataStoreWriter->queueTask(new \Timetabio\Library\Tasks\IndexPostTask($postId));

            return $post;
        }
    }
}
