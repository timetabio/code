<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Post\Revoke
{
    use Timetabio\API\Commands\DeleteAccessTokenCommand;
    use Timetabio\API\Models\APIModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var DeleteAccessTokenCommand
         */
        private $deleteAccessTokenCommand;

        public function __construct(DeleteAccessTokenCommand $deleteAccessTokenCommand)
        {
            $this->deleteAccessTokenCommand = $deleteAccessTokenCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var APIModel $model */

            $this->deleteAccessTokenCommand->execute($model->getAccessToken());

            $model->setData([
                'revoked' => true
            ]);
        }
    }
}
