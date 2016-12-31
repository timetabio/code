<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Post\Feed\Unfollow
{
    use Timetabio\API\Commands\Feeds\UnfollowFeedCommand;
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
