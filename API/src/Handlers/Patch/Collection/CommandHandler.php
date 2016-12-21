<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Patch\Collection
{

    use Timetabio\API\Commands\UpdateCollectionCommand;
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\Collection\UpdateModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var UpdateCollectionCommand;
         */
        private $updateCollectionCommand;

        public function __construct(UpdateCollectionCommand $updateCollectionCommand)
        {
            $this->updateCollectionCommand = $updateCollectionCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var UpdateModel $model */

            $updates = $model->getUpdates();

            if (empty($updates)) {
                throw new BadRequest('no fields given to update', 'no_update');
            }

            $this->updateCollectionCommand->execute($model->getCollectionId(), $updates);

            $updates['id'] = (string) $model->getCollectionId();

            $model->setData($updates);
        }
    }
}
