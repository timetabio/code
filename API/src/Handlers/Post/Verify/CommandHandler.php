<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Post\Verify
{
    use Timetabio\API\Commands\User\VerifyUserCommand;
    use Timetabio\API\Models\APIModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Http\Request\PostRequest;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var VerifyUserCommand
         */
        private $verifyUserCommand;

        public function __construct(VerifyUserCommand $verifyUserCommand)
        {
            $this->verifyUserCommand = $verifyUserCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var APIModel $model */
            /** @var PostRequest $request */

            $this->verifyUserCommand->execute($model->getAuthUserId());

            $model->setData([
                'id' => (string) $model->getAuthUserId(),
                'is_verified' => true
            ]);
        }
    }
}
