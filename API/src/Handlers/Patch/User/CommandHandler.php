<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Patch\User
{
    use Timetabio\API\Commands\User\UpdateUserCommand;
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\User\UpdateUserModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var UpdateUserCommand
         */
        private $updateUserCommand;

        public function __construct(UpdateUserCommand $updateUserCommand)
        {
            $this->updateUserCommand = $updateUserCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var UpdateUserModel $model */

            $updates = $model->getUpdates();

            if (empty($updates)) {
                throw new BadRequest('no fields given to update', 'no_update');
            }

            $this->updateUserCommand->execute($model->getAuthUserId(), $updates);

            $updates['id'] = (string) $model->getAuthUserId();

            $model->setData($updates);
        }
    }
}
