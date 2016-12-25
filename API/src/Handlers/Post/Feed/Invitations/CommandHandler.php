<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Handlers\Post\Feed\Invitations
{
    use Timetabio\API\Commands\Feed\CreateInvitationCommand;
    use Timetabio\Framework\Handlers\CommandHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Library\Mappers\DocumentMapper;

    class CommandHandler implements CommandHandlerInterface
    {
        /**
         * @var CreateInvitationCommand
         */
        private $createInvitationCommand;

        /**
         * @var DocumentMapper
         */
        private $documentMapper;

        public function __construct(CreateInvitationCommand $createInvitationCommand, DocumentMapper $documentMapper)
        {
            $this->createInvitationCommand = $createInvitationCommand;
            $this->documentMapper = $documentMapper;
        }

        public function execute(AbstractModel $model)
        {
            /** @var \Timetabio\API\Models\Feed\Invitation\CreateModel $model */

            $invitation = new \Timetabio\Library\DataObjects\FeedInvitation(
                $model->getInvitationFeedId(),
                $model->getInvitationUserId(),
                $model->getInvitationUserRole()
            );

            $result = $this->createInvitationCommand->execute($invitation);

            $model->setData($this->documentMapper->map($result));
        }
    }
}
