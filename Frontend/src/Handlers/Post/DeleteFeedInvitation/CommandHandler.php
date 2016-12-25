<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers\Post\DeleteFeedInvitation
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Commands\Feed\DeleteFeedInvitationCommand;
    use Timetabio\Frontend\Models\Action\DeleteFeedUserModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var DeleteFeedInvitationCommand
         */
        private $deleteFeedInvitationCommand;

        public function __construct(DeleteFeedInvitationCommand $deleteFeedInvitationCommand)
        {
            $this->deleteFeedInvitationCommand = $deleteFeedInvitationCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var DeleteFeedUserModel $model */

            $this->deleteFeedInvitationCommand->execute(
                $model->getFeedId(),
                $model->getUserId()
            );

            $model->setData([
                'reload' => true
            ]);
        }
    }
}
