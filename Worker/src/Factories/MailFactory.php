<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Worker\Factories
{
    use Timetabio\Framework\Factories\AbstractChildFactory;

    class MailFactory extends AbstractChildFactory
    {
        public function createVerificationMail(): \Timetabio\Worker\Mails\VerificationMail
        {
            return new \Timetabio\Worker\Mails\VerificationMail(
                $this->getMasterFactory()->createDomBackend()->loadXml(__DIR__ . '/../../data/mails/verification.xhtml'),
                $this->getMasterFactory()->createUriBuilder()
            );
        }

        public function createFeedInvitationMail(): \Timetabio\Worker\Mails\FeedInvitationMail
        {
            return new \Timetabio\Worker\Mails\FeedInvitationMail(
                $this->getMasterFactory()->createDomBackend()->loadXml(__DIR__ . '/../../data/mails/invitation.xhtml'),
                $this->getMasterFactory()->createUriBuilder()
            );
        }
    }
}
