<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers\Post\UpdateFeedDescription
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Commands\Feed\UpdateFeedDescriptionCommand;
    use Timetabio\Frontend\Models\Action\UpdateFeedDescriptionModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var UpdateFeedDescriptionCommand
         */
        private $updateFeedDescriptionCommand;

        public function __construct(UpdateFeedDescriptionCommand $updateFeedDescriptionCommand)
        {
            $this->updateFeedDescriptionCommand = $updateFeedDescriptionCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var UpdateFeedDescriptionModel $model */

            $this->updateFeedDescriptionCommand->execute(
                $model->getFeedId(),
                $model->getFeedDescription()
            );

            $model->setData([
                'reload' => true
            ]);
        }
    }
}
