<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers\Post\UpdateFeedVanity
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Commands\Feed\UpdateFeedVanityCommand;
    use Timetabio\Frontend\Models\Action\UpdateFeedVanityModel;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var UpdateFeedVanityCommand
         */
        private $updateFeedVanityCommand;

        public function __construct(UpdateFeedVanityCommand $updateFeedVanityCommand)
        {
            $this->updateFeedVanityCommand = $updateFeedVanityCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var UpdateFeedVanityModel $model */

            $this->updateFeedVanityCommand->execute(
                $model->getFeedId(),
                $model->getFeedVanity()
            );

            $model->setData([
                'reload' => true
            ]);
        }
    }
}
