<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Worker\Runners
{
    use Timetabio\Framework\Backends\MailBackendInterface;
    use Timetabio\Framework\ValueObjects\EmailAddress;
    use Timetabio\Framework\ValueObjects\EmailPerson;
    use Timetabio\Library\Tasks\SendBetaInvitationTask;
    use Timetabio\Library\Tasks\TaskInterface;
    use Timetabio\Worker\Mails\BetaInvitationMail;
    use Timetabio\Worker\Services\BetaRequestService;

    class SendBetaInvitationRunner implements RunnerInterface
    {
        /**
         * @var BetaRequestService
         */
        private $betaRequestService;

        /**
         * @var BetaInvitationMail
         */
        private $betaInvitationMail;

        /**
         * @var MailBackendInterface
         */
        private $mailBackend;

        public function __construct(BetaRequestService $betaRequestService, BetaInvitationMail $betaInvitationMail, MailBackendInterface $mailBackend)
        {
            $this->betaRequestService = $betaRequestService;
            $this->betaInvitationMail = $betaInvitationMail;
            $this->mailBackend = $mailBackend;
        }

        public function run(TaskInterface $task)
        {
            if (!$task instanceof SendBetaInvitationTask) {
                return;
            }

            $request = $this->betaRequestService->getBetaRequest($task->getInvitationId());

            $this->betaInvitationMail->setRecipient(new EmailPerson(new EmailAddress($request['email'])));
            $this->betaInvitationMail->setBetaRequestId($task->getInvitationId());

            $this->mailBackend->send($this->betaInvitationMail);
        }
    }
}
