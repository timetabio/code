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
    use Timetabio\Library\Tasks\SendPasswordResetEmailTask;
    use Timetabio\Library\Tasks\TaskInterface;
    use Timetabio\Library\ValueObjects\DisplayName;
    use Timetabio\Worker\Mails\PasswordResetMail;
    use Timetabio\Worker\Services\UserService;

    class SendPasswordResetEmailRunner implements RunnerInterface
    {
        /**
         * @var UserService
         */
        private $userService;

        /**
         * @var MailBackendInterface
         */
        private $mailBackend;

        /**
         * @var PasswordResetMail
         */
        private $passwordResetMail;

        public function __construct(UserService $userService, MailBackendInterface $mailBackend, PasswordResetMail $passwordResetMail)
        {
            $this->userService = $userService;
            $this->mailBackend = $mailBackend;
            $this->passwordResetMail = $passwordResetMail;
        }

        public function run(TaskInterface $task)
        {
            if (!$task instanceof SendPasswordResetEmailTask) {
                return;
            }

            $user = $this->userService->getUser($task->getUserId());

            $email = new EmailAddress($user['email']);
            $displayName = new DisplayName($user);

            $this->passwordResetMail->setRecipient(new EmailPerson($email, $displayName));
            $this->passwordResetMail->setToken($task->getToken());

            $this->mailBackend->send($this->passwordResetMail);
        }
    }
}
