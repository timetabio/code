<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Delete\Post
{
    use Timetabio\API\Commands\Posts\DeletePostCommand;
    use Timetabio\API\Models\Post\PostModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var DeletePostCommand
         */
        private $deletePostCommand;

        public function __construct(DeletePostCommand $deletePostCommand)
        {
            $this->deletePostCommand = $deletePostCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var PostModel $model */

            $this->deletePostCommand->execute($model->getPostId());

            $model->setData([
                'deleted' => 1
            ]);
        }
    }
}
