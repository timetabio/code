<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Delete\Collection
{

    use Timetabio\API\Commands\DeleteCollectionCommand;
    use Timetabio\API\Models\Collection\CollectionModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {

        /**
        * @var DeleteCollectionCommand
        */
        private $deleteCollectionCommand;

        public function __construct(DeleteCollectionCommand $deleteCollectionCommand)
        {
            $this->deleteCollectionCommand = $deleteCollectionCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var CollectionModel $model */

            $this->deleteCollectionCommand->execute($model->getCollectionId());
        }
    }
}
