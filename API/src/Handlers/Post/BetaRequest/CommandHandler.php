<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Post\BetaRequest
{
    use Timetabio\API\Commands\BetaRequest\CreateBetaRequestCommand;
    use Timetabio\API\Models\BetaRequest\CreateModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var CreateBetaRequestCommand
         */
        private $createBetaRequestCommand;

        public function __construct(CreateBetaRequestCommand $createBetaRequestCommand)
        {
            $this->createBetaRequestCommand = $createBetaRequestCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var CreateModel $model */

            $model->setData(
                $this->createBetaRequestCommand->execute($model->getEmail())
            );
        }
    }
}
