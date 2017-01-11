<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Survey\Commands
{
    use Timetabio\Framework\Backends\PostgresBackend;

    class InsertCommentCommand
    {
        /**
         * @var PostgresBackend
         */
        private $databaseBackend;

        public function __construct(PostgresBackend $databaseBackend)
        {
            $this->databaseBackend = $databaseBackend;
        }

        public function execute(string $body, string $betaRequest)
        {
            return $this->databaseBackend->insert(
                'INSERT INTO survey_comments (body, beta_request_id)
                 VALUES (:body, :beta_request_id)',
                [
                    'body' => $body,
                    'beta_request_id' => $betaRequest
                ]
            );
        }
    }
}
