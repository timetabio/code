<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Delete\Post
{
    use Timetabio\API\Commands\Posts\DeletePostCommand;
    use Timetabio\API\Models\Post\PostModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var DeletePostCommand
         */
        private $deletePostCommand;

        public function __construct(DeletePostCommand $deletePostCommand)
        {
            $this->deletePostCommand = $deletePostCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var PostModel $model */

            $this->deletePostCommand->execute($model->getPostId());

            $model->setData([
                'deleted' => 1
            ]);
        }
    }
}
