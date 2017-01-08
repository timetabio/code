<?php
/**
 * Copyright (c) 2017 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers\Post\UpdatePostBody
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Commands\UpdatePostBodyCommand;
    use Timetabio\Frontend\Models\Action\UpdatePostBodyModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var UpdatePostBodyCommand
         */
        private $updatePostDescriptionCommand;

        public function __construct(UpdatePostBodyCommand $updatePostDescriptionCommand)
        {
            $this->updatePostDescriptionCommand = $updatePostDescriptionCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var UpdatePostBodyModel $model */

            $this->updatePostDescriptionCommand->execute(
                $model->getPostId(),
                $model->getPostBody()
            );
        }
    }
}
