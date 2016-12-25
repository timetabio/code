<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers\Post\Logout
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Commands\LogoutCommand;
    use Timetabio\Frontend\Models\ActionModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var LogoutCommand
         */
        private $logoutCommand;

        public function __construct(LogoutCommand $logoutCommand)
        {
            $this->logoutCommand = $logoutCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var ActionModel $model */

            $this->logoutCommand->execute();

            // TODO: accept redirect

            $model->setData([
                'redirect' => '/'
            ]);
        }
    }
}
