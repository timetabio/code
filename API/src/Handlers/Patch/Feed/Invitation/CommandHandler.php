<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Patch\Feed\Invitation
{
    use Timetabio\API\Commands\Feed\UpdateInvitationCommand;
    use Timetabio\API\Models\Feed\Invitation\UpdateModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var UpdateInvitationCommand
         */
        private $updateInvitationCommand;

        public function __construct(UpdateInvitationCommand $updateInvitationCommand)
        {
            $this->updateInvitationCommand = $updateInvitationCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var UpdateModel $model */

            $this->updateInvitationCommand->execute(
                $model->getFeedId(),
                $model->getUserId(),
                $model->getRole()
            );

            $model->setData([
                'user_id' => $model->getUserId(),
                'role' => (string) $model->getRole()
            ]);
        }
    }
}
