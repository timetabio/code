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
    use Timetabio\Frontend\Models\Action\PostModel;
    use Timetabio\Library\Builders\UriBuilder;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var DeletePostCommand
         */
        private $deletePostCommand;

        public function __construct(DeletePostCommand $deletePostCommand)
        {
            $this->deletePostCommand = $deletePostCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var PostModel $model */

            $this->deletePostCommand->execute($model->getPostId());

            $model->setData([
                'toast' => [
                    'message' => 'The post has been archived, it will be deleted after 30 days.',
                    'ttl' => 5000,
                    'reload' => true,
                    'action' => [
                        'icon' => 'actions/revert',
                        'label' => 'Undo',
                        'uri' => '/action/post/restore',
                        'data' => [
                            'post-id' => $model->getPostId()
                        ]
                    ]
                ]
            ]);
        }
    }
}
