<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\Logging\Loggers
{
    use Timetabio\Framework\Curl\Curl;
    use Timetabio\Framework\Logging\Logs\AbstractLog;
    use Timetabio\Framework\Logging\Logs\EmergencyLog;
    use Timetabio\Framework\ValueObjects\Uri;

    class SlackLogger implements LoggerInterface
    {
        /**
         * @var Curl
         */
        private $curl;

        /**
         * @var Uri
         */
        private $endpoint;

        public function __construct(Curl $curl, Uri $endpoint)
        {
            $this->curl = $curl;
            $this->endpoint = $endpoint;
        }

        public function log(AbstractLog $log)
        {
            $text = [
                '*' . $log->getMessage() . '*',
                'in `' . $log->getFile() . ':' . $log->getLine() . '`',
                '```' . $log->getStringTrace() . '```'
            ];

            $this->curl->post($this->endpoint, [
                'payload' => json_encode([
                    'text' => implode(PHP_EOL, $text)
                ]),
            ]);
        }

        public function handles(AbstractLog $log): bool
        {
            return $log instanceof EmergencyLog;
        }
    }
}
