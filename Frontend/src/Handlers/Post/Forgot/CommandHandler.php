<?php
namespace Timetabio\Frontend\Handlers\Post\Forgot
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Commands\ForgotCommand;
    use Timetabio\Frontend\Exceptions\ApiException;
    use Timetabio\Frontend\Models\Action\ForgotModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var ForgotCommand
         */
        private $forgotCommand;

        public function __construct(ForgotCommand $forgotCommand)
        {
            $this->forgotCommand = $forgotCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var ForgotModel $model */

            $data = ['redirect' => '/account/begin-reset/sent'];

            try {
                $this->forgotCommand->execute($model->getInputUser());
            } catch (ApiException $exception) {
                $data = [
                    'error' => $exception->getMessage()
                ];
            }

            $model->setData($data);
        }
    }
}
