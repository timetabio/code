<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Post\Posts
{
    use Timetabio\API\Commands\Posts\CreatePostCommand;
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\Post\CreateModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Library\Mappers\PostMapper;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var CreatePostCommand
         */
        private $createPostCommand;

        /**
         * @var PostMapper
         */
        private $postMapper;

        public function __construct(CreatePostCommand $createPostCommand, PostMapper $postMapper)
        {
            $this->createPostCommand = $createPostCommand;
            $this->postMapper = $postMapper;
        }

        public function execute(AbstractModel $model)
        {
            /** @var CreateModel $model */

            if ($model->getPostType() instanceof \Timetabio\Library\PostTypes\Event && $model->getPostTimestamp() === null) {
                throw new BadRequest('required parameter \'timestamp\' missing', 'parameter_missing');
            }

            if ($model->getPostTitle() === '') {
                throw new BadRequest('empty post title', 'empty_post_title');
            }

            $post = $this->createPostCommand->execute(
                $model->getPostType(),
                $model->getPostTitle(),
                $model->getPostBody(),
                $model->getFeedId(),
                $model->getAuthUserId(),
                $model->getPostTimestamp(),
                $model->getPostAttachments()
            );

            $model->setData(
                $this->postMapper->map($post)
            );

            $model->setStatusCode(new \Timetabio\Framework\Http\StatusCodes\Created);
        }
    }
}
