<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Handlers\Post\DeletePost
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Commands\DeletePostCommand;
    use Timetabio\Frontend\Models\Action\DeletePostModel;
    use Timetabio\Library\Builders\UriBuilder;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var DeletePostCommand
         */
        private $deletePostCommand;

        /**
         * @var UriBuilder
         */
        private $uriBuilder;

        public function __construct(DeletePostCommand $deletePostCommand, UriBuilder $uriBuilder)
        {
            $this->deletePostCommand = $deletePostCommand;
            $this->uriBuilder = $uriBuilder;
        }

        public function execute(AbstractModel $model)
        {
            /** @var DeletePostModel $model */

            $this->deletePostCommand->execute($model->getPostId());

            $model->setData([
                'redirect' => $this->uriBuilder->buildFeedPageUri($model->getFeedId())
            ]);
        }
    }
}
