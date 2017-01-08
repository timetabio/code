<?php
/**
 * Copyright (c) 2017 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers\Post\UpdatePostTitle
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Commands\UpdatePostTitleCommand;
    use Timetabio\Frontend\Models\Action\UpdatePostTitleModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var UpdatePostTitleCommand
         */
        private $updatePostTitleCommand;

        public function __construct(UpdatePostTitleCommand $updatePostTitleCommand)
        {
            $this->updatePostTitleCommand = $updatePostTitleCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var UpdatePostTitleModel $model */

            $this->updatePostTitleCommand->execute(
                $model->getPostId(),
                $model->getPostTitle()
            );
        }
    }
}
