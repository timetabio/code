<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Survey\Queries
{
    use Timetabio\Framework\Backends\PostgresBackend;

    class FetchBetaRequestQuery
    {
        /**
         * @var PostgresBackend
         */
        private $databaseBackend;

        public function __construct(PostgresBackend $databaseBackend)
        {
            $this->databaseBackend = $databaseBackend;
        }

        public function execute(string $id)
        {
            return $this->databaseBackend->fetch(
                'SELECT beta_requests.* FROM beta_requests
                      LEFT OUTER JOIN users ON beta_requests.email = users.email
                      WHERE beta_requests.id = :id OR users.id = :id
                      ',
                [
                    'id' => $id
                ]
            );
        }
    }
}
