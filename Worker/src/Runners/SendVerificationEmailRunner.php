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
    use Timetabio\Library\Tasks\SendVerificationEmailTask;
    use Timetabio\Library\Tasks\TaskInterface;
    use Timetabio\Worker\Mails\VerificationMail;

    class SendVerificationEmailRunner implements RunnerInterface
    {
        /**
         * @var MailBackendInterface
         */
        private $mailBackend;

        /**
         * @var VerificationMail
         */
        private $verificationMail;

        public function __construct(MailBackendInterface $mailBackend, VerificationMail $verificationMail)
        {
            $this->mailBackend = $mailBackend;
            $this->verificationMail = $verificationMail;
        }

        public function run(TaskInterface $task)
        {
            if (!($task instanceof SendVerificationEmailTask)) {
                return;
            }

            $this->verificationMail->setRecipient($task->getPerson());
            $this->verificationMail->setToken($task->getToken());

            $this->mailBackend->send($this->verificationMail);
        }
    }
}
