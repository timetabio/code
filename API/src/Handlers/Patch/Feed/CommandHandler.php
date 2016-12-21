<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Patch\Feed
{
    use Timetabio\API\Commands\Feed\SetFeedVanityCommand;
    use Timetabio\API\Commands\Feeds\UpdateFeedCommand;
    use Timetabio\API\Models\Feed\UpdateModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var UpdateFeedCommand
         */
        private $updateFeedCommand;

        /**
         * @var SetFeedVanityCommand
         */
        private $setFeedVanityCommand;

        public function __construct(
            UpdateFeedCommand $updateFeedCommand,
            SetFeedVanityCommand $setFeedVanityCommand
        )
        {
            $this->updateFeedCommand = $updateFeedCommand;
            $this->setFeedVanityCommand = $setFeedVanityCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var UpdateModel $model */

            $feedId = $model->getFeedId();
            $updates = $model->getUpdates();

            if (!empty($updates)) {
                $this->updateFeedCommand->execute($feedId, $updates);
            }

            if ($model->hasFeedVanity()) {
                $vanity = (string) $model->getFeedVanity();
                $updates['vanity'] = $vanity;

                $this->setFeedVanityCommand->execute($feedId, $vanity);
            }

            $updates['id'] = (string) $feedId;

            $model->setData($updates);
        }
    }
}
