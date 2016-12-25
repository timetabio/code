<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Delete\Feed\People
{
    use Timetabio\API\Commands\Feeds\DeleteFeedPersonCommand;
    use Timetabio\API\Models\Feed\People\DeleteModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var DeleteFeedPersonCommand
         */
        private $deleteFeedPersonCommand;

        public function __construct(DeleteFeedPersonCommand $deleteFeedPersonCommand)
        {
            $this->deleteFeedPersonCommand = $deleteFeedPersonCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var DeleteModel $model */

            $this->deleteFeedPersonCommand->execute($model->getFeedId(), $model->getUserId());

            $model->setData([
                'deleted' => true
            ]);
        }
    }
}
