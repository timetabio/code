<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Post\Verify
{
    use Timetabio\API\Commands\User\VerifyUserCommand;
    use Timetabio\API\Models\APIModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Http\Request\PostRequest;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var VerifyUserCommand
         */
        private $verifyUserCommand;

        public function __construct(VerifyUserCommand $verifyUserCommand)
        {
            $this->verifyUserCommand = $verifyUserCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var APIModel $model */
            /** @var PostRequest $request */

            $this->verifyUserCommand->execute($model->getAuthUserId());

            $model->setData([
                'id' => (string) $model->getAuthUserId(),
                'is_verified' => true
            ]);
        }
    }
}
