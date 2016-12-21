<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Handlers\Post\Login
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Commands\LoginCommand;
    use Timetabio\Frontend\Exceptions\ApiException;
    use Timetabio\Frontend\Models\Action\LoginModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var LoginCommand
         */
        private $loginCommand;

        public function __construct(LoginCommand $loginCommand)
        {
            $this->loginCommand = $loginCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var LoginModel $model */

            $data = ['redirect' => '/'];

            try {
                $this->loginCommand->execute($model->getLoginUser(), $model->getPassword());
            } catch (ApiException $exception) {
                $data = [
                    'error' => $exception->getMessage()
                ];
            }

            $model->setData($data);
        }
    }
}
