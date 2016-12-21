<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Delete\Feed\Invitation
{
    use Timetabio\API\Commands\Feed\DeleteInvitationCommand;
    use Timetabio\API\Models\Feed\Invitation\UpdateModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var DeleteInvitationCommand
         */
        private $deleteInvitationCommand;

        public function __construct(DeleteInvitationCommand $deleteInvitationCommand)
        {
            $this->deleteInvitationCommand = $deleteInvitationCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var UpdateModel $model */

            $this->deleteInvitationCommand->execute($model->getFeedId(), $model->getUserId());

            $model->setData([
                'deleted' => true
            ]);
        }
    }
}
