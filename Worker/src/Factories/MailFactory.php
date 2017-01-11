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

        public function createPasswordResetEmail(): \Timetabio\Worker\Mails\PasswordResetMail
        {
            return new \Timetabio\Worker\Mails\PasswordResetMail(
                $this->getMasterFactory()->createDomBackend()->loadXml(__DIR__ . '/../../data/mails/reset.xhtml'),
                $this->getMasterFactory()->createUriBuilder()
            );
        }

        public function createBetaInvitationMail(): \Timetabio\Worker\Mails\BetaInvitationMail
        {
            return new \Timetabio\Worker\Mails\BetaInvitationMail(
                $this->getMasterFactory()->createDomBackend()->loadXml(__DIR__ . '/../../data/mails/beta-invitation.xhtml')
            );
        }

        public function createSurveyMail(): \Timetabio\Worker\Mails\SurveyMail
        {
            return new \Timetabio\Worker\Mails\SurveyMail(
                $this->getMasterFactory()->createDomBackend()->loadXml(__DIR__ . '/../../data/mails/survey.xhtml')
            );
        }
    }
}
