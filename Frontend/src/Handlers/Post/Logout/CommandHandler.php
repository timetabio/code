<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Handlers\Post\Logout
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Commands\LogoutCommand;
    use Timetabio\Frontend\Models\ActionModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var LogoutCommand
         */
        private $logoutCommand;

        public function __construct(LogoutCommand $logoutCommand)
        {
            $this->logoutCommand = $logoutCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var ActionModel $model */

            $this->logoutCommand->execute();

            // TODO: accept redirect

            $model->setData([
                'redirect' => '/'
            ]);
        }
    }
}
