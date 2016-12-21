<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Handlers\Post\DeleteFeedInvitation
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Commands\Feed\DeleteFeedInvitationCommand;
    use Timetabio\Frontend\Models\Action\DeleteFeedUserModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var DeleteFeedInvitationCommand
         */
        private $deleteFeedInvitationCommand;

        public function __construct(DeleteFeedInvitationCommand $deleteFeedInvitationCommand)
        {
            $this->deleteFeedInvitationCommand = $deleteFeedInvitationCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var DeleteFeedUserModel $model */

            $this->deleteFeedInvitationCommand->execute(
                $model->getFeedId(),
                $model->getUserId()
            );

            $model->setData([
                'reload' => true
            ]);
        }
    }
}
