<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Services
{
    use Timetabio\Framework\Backends\PostgresBackend;

    class FileService
    {
        /**
         * @var PostgresBackend
         */
        private $databaseBackend;

        public function __construct(PostgresBackend $databaseBackend)
        {
            $this->databaseBackend = $databaseBackend;
        }

        public function createFile(string $ownerId, string $publicId, string $filename, string $mimeType): array
        {
            return $this->databaseBackend->fetch(
                'INSERT INTO files (owner_id, public_id, name, mime_type)
                 VALUES (:owner_id, :public_id, :name, :mime_type)
                 RETURNING *',
                [
                    'owner_id' => $ownerId,
                    'public_id' => $publicId,
                    'name' => $filename,
                    'mime_type' => $mimeType
                ]
            );
        }

        public function getByPublicId(string $publicId)
        {
            return $this->databaseBackend->fetch('SELECT * FROM files WHERE public_id = :public_id', [
                'public_id' => $publicId
            ]);
        }
    }
}
