<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Patch\Feed\User
{
    use Timetabio\API\Commands\Feed\UpdateFeedUserCommand;
    use Timetabio\API\Models\Feed\User\UpdateModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var UpdateFeedUserCommand
         */
        private $updateFeedUserCommand;

        public function __construct(UpdateFeedUserCommand $updateFeedUserCommand)
        {
            $this->updateFeedUserCommand = $updateFeedUserCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var UpdateModel $model */

            $this->updateFeedUserCommand->execute(
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
