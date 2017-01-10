<?php
/**
 * Copyright (c) 2017 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
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
    use Timetabio\Library\Tasks\SendSurveyMailTask;
    use Timetabio\Library\Tasks\TaskInterface;
    use Timetabio\Worker\Mails\BetaInvitationMail;
    use Timetabio\Worker\Mails\SurveyMail;
    use Timetabio\Worker\Services\BetaRequestService;

    class SendSurveyMailRunner implements RunnerInterface
    {
        /**
         * @var BetaRequestService
         */
        private $betaRequestService;

        /**
         * @var SurveyMail
         */
        private $surveyMail;

        /**
         * @var MailBackendInterface
         */
        private $mailBackend;

        public function __construct(BetaRequestService $betaRequestService, SurveyMail $surveyMail, MailBackendInterface $mailBackend)
        {
            $this->betaRequestService = $betaRequestService;
            $this->surveyMail = $surveyMail;
            $this->mailBackend = $mailBackend;
        }

        public function run(TaskInterface $task)
        {
            if (!$task instanceof SendSurveyMailTask) {
                return;
            }

            $request = $this->betaRequestService->getBetaRequest($task->getInvitationId());

            $this->surveyMail->setRecipient(new EmailPerson(new EmailAddress($request['email'])));
            $this->surveyMail->setBetaRequestId($task->getInvitationId());

            $this->mailBackend->send($this->surveyMail);
        }
    }
}
