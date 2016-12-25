<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers\Post\UpdateFeedName
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Commands\Feed\UpdateFeedNameCommand;
    use Timetabio\Frontend\Models\Action\UpdateFeedNameModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var UpdateFeedNameCommand
         */
        private $updateFeedNameCommand;

        public function __construct(UpdateFeedNameCommand $updateFeedNameCommand)
        {
            $this->updateFeedNameCommand = $updateFeedNameCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var UpdateFeedNameModel $model */

            $this->updateFeedNameCommand->execute(
                $model->getFeedId(),
                $model->getFeedName()
            );

            $model->setData([
                'reload' => true
            ]);
        }
    }
}
