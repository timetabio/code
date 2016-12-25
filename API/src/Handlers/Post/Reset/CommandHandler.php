<?php
/**
 * Copyright (c) 2016 Manuel Lopez <manuel.lopez@stud.bbbaden.ch>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Post\Reset
{
    use Timetabio\API\Commands\User\UpdateUserCommand;
    use Timetabio\API\DataStore\DataStoreWriter;
    use Timetabio\API\Models\ResetPasswordModel;
    use Timetabio\API\ValueObjects\Hash;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var UpdateUserCommand
         */
        private $updateUserCommand;

        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        public function __construct(
            UpdateUserCommand $updateUserCommand,
            DataStoreWriter $dataStoreWriter
        )
        {
            $this->updateUserCommand = $updateUserCommand;
            $this->dataStoreWriter = $dataStoreWriter;
        }

        public function execute(AbstractModel $model)
        {
            /** @var ResetPasswordModel $model */

            $this->updateUserCommand->execute($model->getUserId(), ['password' => (string) new Hash($model->getNewPassword())]);
            $this->dataStoreWriter->removeResetToken($model->getToken());

            $model->setData(['updated' => true]);
        }
    }
}
