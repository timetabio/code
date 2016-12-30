<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers\Post\RestorePost
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Commands\RestorePostCommand;
    use Timetabio\Frontend\Models\Action\PostModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var RestorePostCommand
         */
        private $restorePostCommand;

        public function __construct(RestorePostCommand $restorePostCommand)
        {
            $this->restorePostCommand = $restorePostCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var PostModel $model */

            $this->restorePostCommand->execute($model->getPostId());

            $model->setData([
                'reload' => true
            ]);
        }
    }
}
