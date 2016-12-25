<?php
/**
 * Copyright (c) 2016 Manuel Lopez <manuel.lopez@stud.bbbaden.ch>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Put\User
{
    use Timetabio\API\Commands\User\UpdateUserCommand;
    use Timetabio\API\ValueObjects\Hash;
    use Timetabio\API\Models\User\UpdateUserPasswordModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var UpdateUserCommand
         */
        private $updateUserCommand;

        public function __construct(
            UpdateUserCommand $updateUserCommand
        )
        {
            $this->updateUserCommand = $updateUserCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var UpdateUserPasswordModel $model */

            $this->updateUserCommand->execute($model->getAuthUserId(), ['password' => (string) new Hash($model->getNewPassword())]);

            $model->setData(['updated' => true]);
        }
    }
}
