<?php
namespace Timetabio\Frontend\Handlers\Post\BeginReset
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Commands\BeginResetCommand;
    use Timetabio\Frontend\Exceptions\ApiException;
    use Timetabio\Frontend\Models\Action\BeginResetModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var BeginResetCommand
         */
        private $beginResetCommand;

        public function __construct(BeginResetCommand $beginResetCommand)
        {
            $this->beginResetCommand = $beginResetCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var BeginResetModel $model */

            $data = ['redirect' => '/account/begin-reset/sent'];

            try {
                $this->beginResetCommand->execute($model->getInputUser());
            } catch (ApiException $exception) {
                $data = [
                    'error' => $exception->getMessage()
                ];
            }

            $model->setData($data);
        }
    }
}
