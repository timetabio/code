<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Post\Feed\Follow
{
    use Timetabio\API\Commands\Feed\DeleteInvitationCommand;
    use Timetabio\API\Commands\Feeds\FollowFeedCommand;
    use Timetabio\API\Models\Feed\FollowModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var FollowFeedCommand
         */
        private $followFeedCommand;

        /**
         * @var DeleteInvitationCommand
         */
        private $deleteInvitationCommand;

        public function __construct(FollowFeedCommand $followFeedCommand, DeleteInvitationCommand $deleteInvitationCommand)
        {
            $this->followFeedCommand = $followFeedCommand;
            $this->deleteInvitationCommand = $deleteInvitationCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var FollowModel $model */

            $feedId = $model->getFeedId();
            $authUserId = $model->getAuthUserId();

            if (!$model->isFollowing()) {
                $this->followFeedCommand->execute($feedId, $authUserId, $model->getRole());
                $this->deleteInvitationCommand->execute($feedId, $authUserId);
            }

            $model->setData([
                'feed_id' => $model->getFeedId(),
                'role' => $model->getRole()
            ]);
        }
    }
}
