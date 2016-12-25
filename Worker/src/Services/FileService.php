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

    class FileService
    {
        /**
         * @var PostgresBackend
         */
        private $postgresBackend;

        public function __construct(PostgresBackend $postgresBackend)
        {
            $this->postgresBackend = $postgresBackend;
        }

        public function getUnusedFiles(int $limit): array
        {
            return $this->postgresBackend->fetchAll(
                'SELECT files.* FROM files
                 LEFT JOIN post_attachments ON post_attachments.file_id = files.id
                 WHERE  post_attachments.id IS NULL
                   AND files.created < (utc_now() - INTERVAL \'24 hours\')
                 LIMIT :limit',
                [
                    'limit' => $limit
                ]
            );
        }

        public function deleteFile(string $fileId)
        {
            $this->postgresBackend->execute('DELETE FROM files WHERE id = :id', [
                'id' => $fileId
            ]);
        }
    }
}
