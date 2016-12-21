<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Handlers\Post\DeleteFeedUser
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Commands\DeleteFeedUserCommand;
    use Timetabio\Frontend\Exceptions\ApiException;
    use Timetabio\Frontend\Models\Action\DeleteFeedUserModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var DeleteFeedUserCommand
         */
        private $deleteFeedUserCommand;

        public function __construct(DeleteFeedUserCommand $deleteFeedUserCommand)
        {
            $this->deleteFeedUserCommand = $deleteFeedUserCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var DeleteFeedUserModel $model */

            try {
                $this->deleteFeedUserCommand->execute($model->getFeedId(), $model->getUserId());
            } catch (ApiException $exception) {
            }

            $model->setData([
                'reload' => true
            ]);
        }
    }
}
