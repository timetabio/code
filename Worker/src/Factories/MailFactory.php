<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
