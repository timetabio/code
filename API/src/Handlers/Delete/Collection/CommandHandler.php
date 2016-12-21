<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Delete\Collection
{

    use Timetabio\API\Commands\DeleteCollectionCommand;
    use Timetabio\API\Models\Collection\CollectionModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {

        /**
        * @var DeleteCollectionCommand
        */
        private $deleteCollectionCommand;

        public function __construct(DeleteCollectionCommand $deleteCollectionCommand)
        {
            $this->deleteCollectionCommand = $deleteCollectionCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var CollectionModel $model */

            $this->deleteCollectionCommand->execute($model->getCollectionId());
        }
    }
}
