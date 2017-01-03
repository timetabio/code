<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Library\Tasks
{
    class SendBetaInvitationTask implements TaskInterface
    {
        /**
         * @var string
         */
        private $invitationId;

        public function __construct(string $invitationId)
        {
            $this->invitationId = $invitationId;
        }

        public function getInvitationId(): string
        {
            return $this->invitationId;
        }

        public function getPriority(): \Timetabio\Library\TaskPriorities\Priority
        {
            return new \Timetabio\Library\TaskPriorities\Normal;
        }
    }
}