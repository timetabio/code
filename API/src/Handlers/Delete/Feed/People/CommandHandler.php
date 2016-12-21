<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Delete\Feed\People
{
    use Timetabio\API\Commands\Feeds\DeleteFeedPersonCommand;
    use Timetabio\API\Models\Feed\People\DeleteModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var DeleteFeedPersonCommand
         */
        private $deleteFeedPersonCommand;

        public function __construct(DeleteFeedPersonCommand $deleteFeedPersonCommand)
        {
            $this->deleteFeedPersonCommand = $deleteFeedPersonCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var DeleteModel $model */

            $this->deleteFeedPersonCommand->execute($model->getFeedId(), $model->getUserId());

            $model->setData([
                'deleted' => true
            ]);
        }
    }
}
