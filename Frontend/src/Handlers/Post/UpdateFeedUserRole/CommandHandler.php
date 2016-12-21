<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Handlers\Post\UpdateFeedUserRole
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Commands\Feed\UpdateFeedUserRoleCommand;
    use Timetabio\Frontend\Models\Action\UpdateFeedUserRoleModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var UpdateFeedUserRoleCommand
         */
        private $updateFeedUserRoleCommand;

        public function __construct(UpdateFeedUserRoleCommand $updateFeedUserRoleCommand)
        {
            $this->updateFeedUserRoleCommand = $updateFeedUserRoleCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var UpdateFeedUserRoleModel $model */

            $this->updateFeedUserRoleCommand->execute(
                $model->getFeedId(),
                $model->getUserId(),
                $model->getRole()
            );

            $model->setData([
                'toast' => [
                    'message' => 'The user\'s role has been updated'
                ]
            ]);
        }
    }
}
