<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Post\Collections
{
    use Timetabio\API\Commands\CreateCollectionCommand;
    use Timetabio\API\Models\Collection\CreateModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Library\Mappers\DocumentMapper;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var CreateCollectionCommand
         */
        private $createCollectionCommand;

        /**
         * @var DocumentMapper
         */
        private $documentMapper;

        public function __construct(
            CreateCollectionCommand $createCollectionCommand,
            DocumentMapper $documentMapper
        )
        {
            $this->createCollectionCommand = $createCollectionCommand;
            $this->documentMapper = $documentMapper;
        }

        public function execute(AbstractModel $model)
        {
            /** @var CreateModel $model */

            $collection = $this->createCollectionCommand->execute(
                $model->getCollectionName(),
                $model->getAuthUserId()
            );

            $model->setData($this->documentMapper->map($collection));
        }
    }
}
