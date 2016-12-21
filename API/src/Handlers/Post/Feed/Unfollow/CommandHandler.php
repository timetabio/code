<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Handlers\Post\Feed\Unfollow
{
    use Timetabio\API\Commands\Feeds\UnfollowFeedCommand;
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\Feed\FollowModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var UnfollowFeedCommand
         */
        private $unfollowFeedCommand;

        public function __construct(UnfollowFeedCommand $unfollowFeedCommand)
        {
            $this->unfollowFeedCommand = $unfollowFeedCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var FollowModel $model */

            if ($model->isFollowing()) {
                $this->unfollowFeedCommand->execute($model->getFeedId(), $model->getAuthUserId());
            }

            $model->setData([
                'feed_id' => $model->getFeedId()
            ]);
        }
    }
}
