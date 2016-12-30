<?php
namespace Timetabio\API\Handlers\Put\User
{
    use Timetabio\API\Commands\User\UpdateUserCommand;
    use Timetabio\API\Models\User\UpdateUserPasswordModel;
    use Timetabio\API\ValueObjects\Hash;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var UpdateUserCommand
         */
        private $updateUserCommand;

        public function __construct(
            UpdateUserCommand $updateUserCommand
        )
        {
            $this->updateUserCommand = $updateUserCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var UpdateUserPasswordModel $model */

            $this->updateUserCommand->execute($model->getAuthUserId(), ['password' => (string) new Hash($model->getNewPassword())]);

            $model->setData(['updated' => true]);
        }
    }
}
