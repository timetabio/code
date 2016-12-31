<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Worker\Services
{
    use Timetabio\Framework\Backends\PostgresBackend;

    class BetaRequestService
    {
        /**
         * @var PostgresBackend
         */
        private $postgresBackend;

        public function __construct(PostgresBackend $postgresBackend)
        {
            $this->postgresBackend = $postgresBackend;
        }

        public function getBetaRequestIds(): \Traversable
        {
            return $this->postgresBackend->fetchColumns('SELECT id FROM beta_requests');
        }

        public function getBetaRequest(string $id): ?array
        {
            return $this->postgresBackend->fetch(
                'SELECT * FROM beta_requests WHERE id = :id',
                [
                    'id' => $id
                ]
            );
        }
    }
}
