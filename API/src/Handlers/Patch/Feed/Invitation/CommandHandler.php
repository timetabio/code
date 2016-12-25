<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Patch\Feed\Invitation
{
    use Timetabio\API\Commands\Feed\UpdateInvitationCommand;
    use Timetabio\API\Models\Feed\Invitation\UpdateModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var UpdateInvitationCommand
         */
        private $updateInvitationCommand;

        public function __construct(UpdateInvitationCommand $updateInvitationCommand)
        {
            $this->updateInvitationCommand = $updateInvitationCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var UpdateModel $model */

            $this->updateInvitationCommand->execute(
                $model->getFeedId(),
                $model->getUserId(),
                $model->getRole()
            );

            $model->setData([
                'user_id' => $model->getUserId(),
                'role' => (string) $model->getRole()
            ]);
        }
    }
}
