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
    use Timetabio\API\ValueObjects\CollectionId;
    use Timetabio\API\ValueObjects\CollectionName;
    use Timetabio\API\ValueObjects\UserId;
    use Timetabio\Framework\Backends\PostgresBackend;

    class CollectionService
    {
        /**
         * @var PostgresBackend
         */
        private $databaseBackend;

        public function __construct(PostgresBackend $databaseBackend)
        {
            $this->databaseBackend = $databaseBackend;
        }

        public function getCollectionById(CollectionId $collectionId)
        {
            return $this->databaseBackend->fetch('SELECT * FROM collections WHERE id = :id', [
                'id' => (string) $collectionId
            ]);
        }

        public function getCollectionsByUser(UserId $userId, int $limit, int $page = 1): array
        {
            return $this->databaseBackend->fetchAll(
                'SELECT * FROM collections WHERE owner_id = :id LIMIT :limit OFFSET :offset',
                [
                    'id' => (string) $userId,
                    'limit' => $limit,
                    'offset' => $limit * ($page - 1)
                ]
            );
        }

        public function createCollection(CollectionName $collectionName, UserId $userId): array
        {
            return $this->databaseBackend->insert(
                'INSERT INTO collections (name, owner_id) VALUES (:name, :owner_id) RETURNING *',
                [
                    'name' => (string) $collectionName,
                    'owner_id' => (string) $userId
                ]
            );
        }

        public function updateCollection(CollectionId $collectionId, array $updates)
        {
            $fields = [];

            foreach ($updates as $field => $_) {
                $fields[] = $field . ' = :' . $field;
            }

            $updates['id'] = (string) $collectionId;

            $this->databaseBackend->execute('UPDATE collections SET ' . implode(', ', $fields) . ' WHERE id = :id', $updates);
        }

        public function deleteCollection(CollectionId $collectionId)
        {
            $this->databaseBackend->execute('DELETE FROM collections WHERE id = :id', [
                'id' => (string) $collectionId
            ]);
        }
    }
}
