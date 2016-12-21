<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
