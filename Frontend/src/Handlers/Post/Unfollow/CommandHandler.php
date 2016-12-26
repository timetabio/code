<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers\Post\Unfollow
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Commands\Feed\UnfollowFeedCommand;
    use Timetabio\Frontend\Exceptions\BadRequest;
    use Timetabio\Frontend\Models\Action\FollowModel;
    use Timetabio\Library\Builders\UriBuilder;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var UnfollowFeedCommand
         */
        private $unfollowFeedCommand;

        /**
         * @var UriBuilder
         */
        private $uriBuilder;

        public function __construct(UnfollowFeedCommand $unfollowFeedCommand, UriBuilder $uriBuilder)
        {
            $this->unfollowFeedCommand = $unfollowFeedCommand;
            $this->uriBuilder = $uriBuilder;
        }

        public function execute(AbstractModel $model)
        {
            /** @var FollowModel $model */

            $result = $this->unfollowFeedCommand->execute($model->getFeedId());

            if ($result === null) {
                throw new BadRequest('feed does not exist');
            }

            $model->setData([
                'redirect' => $this->uriBuilder->buildFeedPageUri($model->getFeedId())
            ]);
        }
    }
}
