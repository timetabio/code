<?php
/**
 * Copyright (c) 2017 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Put\Post\Body
{
    use Timetabio\API\Commands\Posts\UpdatePostBodyCommand;
    use Timetabio\API\Models\Post\UpdateBodyModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var UpdatePostBodyCommand
         */
        private $updatePostBodyCommand;

        public function __construct(UpdatePostBodyCommand $updatePostBodyCommand)
        {
            $this->updatePostBodyCommand = $updatePostBodyCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var UpdateBodyModel $model */

            $this->updatePostBodyCommand->execute(
                $model->getPostId(),
                $model->getPostBody()
            );

            $model->setData([
                'updated' => true
            ]);
        }
    }
}
