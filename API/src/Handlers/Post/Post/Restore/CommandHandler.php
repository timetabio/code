<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Post\Post\Restore
{
    use Timetabio\API\Commands\Posts\RestorePostCommand;
    use Timetabio\API\Models\Post\ArchiveModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

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
            /** @var ArchiveModel $model */

            $post = $model->getPostInfo();

            if ($post['archived'] !== null) {
                $this->restorePostCommand->execute($model->getPostId());
            }

            $model->setData([
                'archived' => null
            ]);
        }
    }
}
