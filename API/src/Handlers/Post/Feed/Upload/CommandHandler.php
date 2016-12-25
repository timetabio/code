<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Post\Feed\Upload
{
    use Timetabio\API\Commands\Feed\CreateFeedUploadUrlCommand;
    use Timetabio\API\Commands\File\CreateFileCommand;
    use Timetabio\API\Models\Feed\UploadModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var CreateFeedUploadUrlCommand
         */
        private $createFeedUploadUrlCommand;

        /**
         * @var CreateFileCommand
         */
        private $createFileCommand;

        public function __construct(CreateFeedUploadUrlCommand $createFeedUploadUrlCommand, CreateFileCommand $createFileCommand)
        {
            $this->createFeedUploadUrlCommand = $createFeedUploadUrlCommand;
            $this->createFileCommand = $createFileCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var UploadModel $model */

            $uploadParams = $this->createFeedUploadUrlCommand->execute(
                $model->getFilename(),
                $model->getMimeType()
            );

            $this->createFileCommand->execute(
                $model->getAuthUserId(),
                $uploadParams->getFile(),
                $model->getMimeType()
            );

            $model->setData([
                'public_id' => (string) $uploadParams->getFile()->getPublicId(),
                'endpoint' => $uploadParams->getEndpoint(),
                'params' => $uploadParams->getParams()
            ]);
        }
    }
}
