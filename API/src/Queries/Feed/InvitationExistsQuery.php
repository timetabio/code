<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Queries\Feed
{
    use Timetabio\Library\Services\FeedInvitationService;

    class InvitationExistsQuery
    {
        /**
         * @var FeedInvitationService
         */
        private $feedInvitationService;

        public function __construct(FeedInvitationService $feedInvitationService)
        {
            $this->feedInvitationService = $feedInvitationService;
        }

        public function execute(string $feedId, string $userId): bool
        {
            return $this->feedInvitationService->hasInvitation($feedId, $userId);
        }
    }
}
