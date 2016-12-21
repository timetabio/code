<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Post\Verify\Resend
{
    use Timetabio\API\Commands\SendVerificationCommand;
    use Timetabio\API\Models\Verify\ResendModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var SendVerificationCommand
         */
        private $sendVerificationCommand;

        public function __construct(SendVerificationCommand $sendVerificationCommand)
        {
            $this->sendVerificationCommand = $sendVerificationCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var ResendModel $model */

            $this->sendVerificationCommand->execute(
                $model->getEmailPerson(),
                $model->getToken()
            );
        }
    }
}
