<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Post\Post\Archive
{
    use Timetabio\API\Commands\Posts\ArchivePostCommand;
    use Timetabio\API\Models\Post\ArchiveModel;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Framework\ValueObjects\StringDateTime;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var ArchivePostCommand
         */
        private $archivePostCommand;

        public function __construct(ArchivePostCommand $archivePostCommand)
        {
            $this->archivePostCommand = $archivePostCommand;
        }

        public function execute(AbstractModel $model)
        {
            /** @var ArchiveModel $model */

            $post = $model->getPostInfo();
            $archived = $post['archived'];

            if ($archived === null) {
                $archived = $this->archivePostCommand->execute($model->getPostId());
            }

            $model->setData([
                'archived' => (new StringDateTime($archived))->getTimestamp()
            ]);
        }
    }
}
