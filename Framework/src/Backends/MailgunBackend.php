<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\Backends
{
    use Timetabio\Framework\Curl\Credentials\BasicAuth;
    use Timetabio\Framework\Curl\Curl;
    use Timetabio\Framework\Logging\LoggerAwareInterface;
    use Timetabio\Framework\Logging\LoggerAwareTrait;
    use Timetabio\Framework\Mails\MailInterface;
    use Timetabio\Framework\ValueObjects\Uri;

    class MailgunBackend implements MailBackendInterface, LoggerAwareInterface
    {
        use LoggerAwareTrait;

        /**
         * @var Curl
         */
        private $curl;

        /**
         * @var string
         */
        private $endpoint;

        /**
         * @var string
         */
        private $apiKey;

        /**
         * @var string
         */
        private $sender;

        public function __construct(
            Curl $curl,
            string $endpoint,
            string $apiKey,
            string $sender
        )
        {
            $this->curl = $curl;
            $this->endpoint = $endpoint;
            $this->apiKey = $apiKey;
            $this->sender = $sender;
        }

        public function send(MailInterface $mail)
        {
            $credentials = new BasicAuth('api', $this->apiKey);
            $url = new Uri($this->endpoint);

            $params = [
                'to' => (string) $mail->getRecipient(),
                'subject' => $mail->getSubject(),
                'from' => $this->sender,
                'html' => $mail->render()
            ];

            $response = $this->curl->post($url, $params, $credentials);

            if ($response->getCode() !== 200) {
                $exception = new \RuntimeException('error sending email via mailgun', $response->getCode());

                $this->getLogger()->emergency($exception);

                throw $exception;
            }
        }
    }
}
