<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers\Post\Upload
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Commands\CreateUploadCommand;
    use Timetabio\Frontend\Models\Action\UploadModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var CreateUploadCommand
         */
        private $createUploadCommand;

        public function __construct(CreateUploadCommand $createUploadCommand)
        {
            $this->createUploadCommand = $createUploadCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var UploadModel $model */

            $model->setData($this->createUploadCommand->execute(
                $model->getFilename(),
                $model->getMimeType()
            ));
        }
    }
}
