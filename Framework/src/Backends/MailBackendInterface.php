<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Backends
{
    use Timetabio\Framework\Mails\MailInterface;

    interface MailBackendInterface
    {
        public function send(MailInterface $mail);
    }
}
