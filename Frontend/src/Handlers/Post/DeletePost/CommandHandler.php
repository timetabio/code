<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Handlers\Post\DeletePost
{
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Commands\DeletePostCommand;
    use Timetabio\Frontend\Models\Action\DeletePostModel;
    use Timetabio\Library\Builders\UriBuilder;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var DeletePostCommand
         */
        private $deletePostCommand;

        /**
         * @var UriBuilder
         */
        private $uriBuilder;

        public function __construct(DeletePostCommand $deletePostCommand, UriBuilder $uriBuilder)
        {
            $this->deletePostCommand = $deletePostCommand;
            $this->uriBuilder = $uriBuilder;
        }

        public function execute(AbstractModel $model)
        {
            /** @var DeletePostModel $model */

            $this->deletePostCommand->execute($model->getPostId());

            $model->setData([
                'redirect' => $this->uriBuilder->buildFeedPageUri($model->getFeedId())
            ]);
        }
    }
}
