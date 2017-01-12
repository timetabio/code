<?php
/**
 * Copyright (c) 2017 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Put\Post\Title
{
    use Timetabio\API\Commands\Posts\UpdatePostTitleCommand;
    use Timetabio\API\Models\Post\UpdateTitleModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

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
            /** @var UpdateTitleModel $model */

            $this->updatePostTitleCommand->execute(
                $model->getPostId(),
                $model->getPostTitle()
            );

            $model->setData([
                'updated' => true
            ]);
        }
    }
}
