<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Patch\Collection
{

    use Timetabio\API\Commands\UpdateCollectionCommand;
    use Timetabio\API\Exceptions\BadRequest;
    use Timetabio\API\Models\Collection\UpdateModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var UpdateCollectionCommand;
         */
        private $updateCollectionCommand;

        public function __construct(UpdateCollectionCommand $updateCollectionCommand)
        {
            $this->updateCollectionCommand = $updateCollectionCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var UpdateModel $model */

            $updates = $model->getUpdates();

            if (empty($updates)) {
                throw new BadRequest('no fields given to update', 'no_update');
            }

            $this->updateCollectionCommand->execute($model->getCollectionId(), $updates);

            $updates['id'] = (string) $model->getCollectionId();

            $model->setData($updates);
        }
    }
}
