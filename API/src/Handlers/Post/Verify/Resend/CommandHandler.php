<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Post\Verify\Resend
{
    use Timetabio\API\Commands\SendVerificationCommand;
    use Timetabio\API\Models\Verify\ResendModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var SendVerificationCommand
         */
        private $sendVerificationCommand;

        public function __construct(SendVerificationCommand $sendVerificationCommand)
        {
            $this->sendVerificationCommand = $sendVerificationCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var ResendModel $model */

            $this->sendVerificationCommand->execute(
                $model->getEmailPerson(),
                $model->getToken()
            );
        }
    }
}
