<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Post\Feeds
{
    use Timetabio\API\Commands\CreateFeedCommand;
    use Timetabio\API\Models\Feed\CreateModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Library\Mappers\DocumentMapper;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var CreateFeedCommand
         */
        private $createFeedCommand;

        /**
         * @var DocumentMapper
         */
        private $documentMapper;

        public function __construct(CreateFeedCommand $createFeedCommand, DocumentMapper $documentMapper)
        {
            $this->createFeedCommand = $createFeedCommand;
            $this->documentMapper = $documentMapper;
        }

        public function execute(AbstractModel $model)
        {
            /** @var CreateModel $model */

            $owner = $model->getAuthUserId();
            $description = $model->getDescription();
            $name = $model->getName();
            $private = $model->isPrivate();

            $feed = $this->createFeedCommand->execute($owner, $name, $description, $private);

            $model->setData($this->documentMapper->map($feed));
            $model->setStatusCode(new \Timetabio\Framework\Http\StatusCodes\Created);
        }
    }
}
