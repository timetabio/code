<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Commands\Feed
{
    use Timetabio\Library\Services\FeedInvitationService;

    class DeleteInvitationCommand
    {
        /**
         * @var FeedInvitationService
         */
        private $invitationService;

        public function __construct(FeedInvitationService $invitationService)
        {
            $this->invitationService = $invitationService;
        }

        public function execute(string $feedId, string $userId)
        {
            $this->invitationService->deleteInvitation($feedId, $userId);
        }
    }
}
