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

    class ApproveBetaRequestCommand
    {
        /**
         * @var PostgresBackend
         */
        private $databaseBackend;

        public function __construct(PostgresBackend $databaseBackend)
        {
            $this->databaseBackend = $databaseBackend;
        }

        public function execute(string $betaRequest)
        {
            $this->databaseBackend->execute(
                'UPDATE beta_requests
                 SET approved = TRUE, survey_before_completed = TRUE
                 WHERE id = :id',
                [
                    'id' => $betaRequest
                ]
            );
        }
    }
}
