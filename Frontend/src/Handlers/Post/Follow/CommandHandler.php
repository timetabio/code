<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Handlers\Post\Follow
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Commands\Feed\FollowFeedCommand;
    use Timetabio\Frontend\Exceptions\BadRequest;
    use Timetabio\Frontend\Models\Action\FollowModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var FollowFeedCommand
         */
        private $followFeedCommand;

        public function __construct(FollowFeedCommand $followFeedCommand)
        {
            $this->followFeedCommand = $followFeedCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var FollowModel $model */

            $result = $this->followFeedCommand->execute($model->getFeedId());

            if ($result === null) {
                throw new BadRequest('feed does not exist');
            }

            $model->setData([
                'reload' => true
            ]);
        }
    }
}
