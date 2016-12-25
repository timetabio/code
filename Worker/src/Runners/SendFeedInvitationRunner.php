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
    use Timetabio\Library\Tasks\SendFeedInvitationTask;
    use Timetabio\Library\Tasks\TaskInterface;
    use Timetabio\Library\ValueObjects\DisplayName;
    use Timetabio\Worker\Mails\FeedInvitationMail;
    use Timetabio\Worker\Services\FeedService;
    use Timetabio\Worker\Services\UserService;

    class SendFeedInvitationRunner implements RunnerInterface
    {
        /**
         * @var UserService
         */
        private $userService;

        /**
         * @var FeedService
         */
        private $feedService;

        /**
         * @var MailBackendInterface
         */
        private $mailBackend;

        /**
         * @var FeedInvitationMail
         */
        private $invitationMail;

        public function __construct(UserService $userService, FeedService $feedService, MailBackendInterface $mailBackend, FeedInvitationMail $invitationMail)
        {
            $this->userService = $userService;
            $this->feedService = $feedService;
            $this->mailBackend = $mailBackend;
            $this->invitationMail = $invitationMail;
        }

        public function run(TaskInterface $task)
        {
            if (!$task instanceof SendFeedInvitationTask) {
                return;
            }

            $invitation = $task->getInvitation();
            $feed = $this->feedService->getFeed($invitation->getFeedId());
            $user = $this->userService->getUser($invitation->getUserId());

            $email = new EmailAddress($user['email']);
            $displayName = new DisplayName($user);

            $this->invitationMail->setFeedId($feed['id']);
            $this->invitationMail->setFeedName($feed['name']);
            $this->invitationMail->setRecipient(new EmailPerson($email, $displayName));
            $this->invitationMail->setRole($invitation->getUserRole());

            $this->mailBackend->send($this->invitationMail);
        }
    }
}
