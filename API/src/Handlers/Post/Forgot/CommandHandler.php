<?php
/**
 * Copyright (c) 2016 Manuel Lopez <manuel.lopez@stud.bbbaden.ch>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Post\Forgot
{
    use Timetabio\API\DataStore\DataStoreWriter;
    use Timetabio\API\Models\ForgotPasswordModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Framework\ValueObjects\Token;
    use Timetabio\Library\Tasks\SendResetPasswordEmailTask;

    class CommandHandler implements CommandHandlerInterface
    {

        /**
         * @var DataStoreWriter
         */
        private $dataStoreWriter;

        public function __construct(
            DataStoreWriter $dataStoreWriter
        )
        {
            $this->dataStoreWriter = $dataStoreWriter;
        }

        public function execute(AbstractModel $model)
        {
            /** @var ForgotPasswordModel $model */

            if(!$model->hasUserData()) {
                return;
            }

            $token = new Token;
            $user = $model->getUserData();

            $this->dataStoreWriter->saveResetToken($model->getUser(), $token);
            $this->dataStoreWriter->queueTask(new SendResetPasswordEmailTask($token, $user['id']));
        }
    }
}
