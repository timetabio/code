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
    use Timetabio\Framework\Pdo\Value\Boolean;
    use Timetabio\Library\UserRoles\UserRole;

    class FeedService
    {
        /**
         * @var PostgresBackend
         */
        private $databaseBackend;

        public function __construct(PostgresBackend $databaseBackend)
        {
            $this->databaseBackend = $databaseBackend;
        }

        public function getFeedById(string $feedId)
        {
            // TODO: refactor (we can't use public_feeds because of invited feeds)
            return $this->databaseBackend->fetch(
                'SELECT feeds.id,
                   feeds.name,
                   feeds.description,
                   feeds.is_verified,
                   feeds.created,
                   feeds.updated
                 FROM feeds
                 WHERE feeds.id = :feed_id',
                [
                    'feed_id' => $feedId
                ]
            );
        }

        public function getFeedByIdForUser(string $feedId, string $userId)
        {
            return $this->databaseBackend->fetch(
                'SELECT feeds.*,
                        feed_users.user_id IS NOT NULL AS has_added  
                 FROM aggregated_feeds AS feeds
                 LEFT OUTER JOIN feed_users ON feeds.id = feed_users.feed_id AND feed_users.user_id = :user_id
                 WHERE feeds.id = :feed_id',
                [
                    'feed_id' => $feedId,
                    'user_id' => $userId
                ]
            );
        }

        public function getUserFeeds(string $userId, int $limit, int $page = 1): array
        {
            return $this->databaseBackend->fetchAll(
                'SELECT * FROM user_feeds
                 WHERE user_id = :user_id
                 ORDER BY user_feeds.name
                 LIMIT :limit
                 OFFSET :offset',
                [
                    'user_id' => $userId,
                    'limit' => $limit,
                    'offset' => $limit * ($page - 1)
                ]
            );
        }

        public function getPublicFeeds(int $limit, int $page = 1)
        {
            return $this->databaseBackend->fetchAll(
                'SELECT * FROM public_feeds
                 LIMIT :limit
                 OFFSET :offset',
                [
                    'limit' => $limit,
                    'offset' => $limit * ($page - 1)
                ]
            );
        }

        public function createFeed(string $ownerId, string $name, string $description, bool $isPrivate): array
        {
            $this->databaseBackend->beginTransaction();

            try {
                $feed = $this->databaseBackend->fetch(
                    'INSERT INTO feeds (name, description, is_private)
                     VALUES (:name, :description, :is_private)
                     RETURNING *',
                    [
                        'name' => $name,
                        'description' => $description,
                        'is_private' => new Boolean($isPrivate)
                    ]
                );

                $owner = $this->databaseBackend->fetch(
                    'INSERT INTO feed_users (feed_id, user_id, role)
                     VALUES (:feed_id, :user_id, :role)
                     RETURNING *',
                    [
                        'feed_id' => $feed['id'],
                        'user_id' => $ownerId,
                        'role' => (string) new \Timetabio\Library\UserRoles\Owner
                    ]
                );
            } catch (\Exception $exception) {
                $this->databaseBackend->rollbackTransaction();
                throw $exception;
            }

            $this->databaseBackend->commitTransaction();

            $feed['owner'] = $owner;

            return $feed;
        }

        public function updateFeed(string $feedId, array $updates)
        {
            $fields = [];

            foreach ($updates as $field => $_) {
                $fields[] = $field . ' = :' . $field;
            }

            $updates['id'] = $feedId;

            $this->databaseBackend->execute('UPDATE feeds SET ' . implode(', ', $fields) . ' WHERE id = :id', $updates);
        }

        public function getVanityByName(string $name)
        {
            return $this->databaseBackend->fetch('SELECT * FROM feed_vanities WHERE lower(name) = :name', [
                'name' => mb_strtolower($name)
            ]);
        }

        public function createFeedVanity(string $feedId, string $vanity): array
        {
            return $this->databaseBackend->fetch(
                'INSERT INTO feed_vanities (name, feed_id) VALUES (:name, :feed_id)
                 ON CONFLICT (feed_id) DO UPDATE SET name = :name
                 RETURNING *',
                [
                    'name' => $vanity,
                    'feed_id' => $feedId
                ]
            );
        }

        public function deleteFeedVanity(string $feedId)
        {
            $this->databaseBackend->execute(
                'DELETE FROM feed_vanities WHERE feed_id = :feed_id',
                [
                    'feed_id' => $feedId
                ]
            );
        }

        public function updateFeedUser(string $feedId, string $userId, UserRole $role)
        {
            $this->databaseBackend->execute(
                'UPDATE feed_users
                 SET role = :role
                 WHERE feed_id = :feed_id AND user_id = :user_id',
                [
                    'feed_id' => $feedId,
                    'user_id' => $userId,
                    'role' => (string) $role
                ]
            );
        }
    }
}
