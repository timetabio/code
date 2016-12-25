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

    /**
     * @deprecated
     */
    class PeopleService
    {
        /**
         * @var PostgresBackend
         */
        private $databaseBackend;

        public function __construct(PostgresBackend $databaseBackend)
        {
            $this->databaseBackend = $databaseBackend;
        }

        /**
         * @deprecated
         */
        public function getPerson(string $feedId, string $userId)
        {
            return $this->databaseBackend->fetch(
                'SELECT * FROM feed_users WHERE feed_id = :feed_id AND user_id = :user_id',
                [
                    'feed_id' => $feedId,
                    'user_id' => $userId
                ]
            );
        }

        /**
         * @deprecated
         */
        public function getPeople(string $feedId): array
        {
            return $this->databaseBackend->fetchAll(
                'SELECT users.name, users.username, feed_users.*
                 FROM feed_users
                 JOIN users ON feed_users.user_id = users.id
                 WHERE feed_id = :feed_id
                 ORDER BY feed_users.role DESC',
                [
                    'feed_id' => $feedId
                ]
            );
        }

        /**
         * @deprecated
         */
        public function deletePerson(string $feedId, string $userId)
        {
            $this->databaseBackend->execute(
                'DELETE FROM feed_users WHERE feed_id = :feed_id AND user_id = :user_id',
                [
                    'feed_id' => $feedId,
                    'user_id' => $userId
                ]
            );
        }

        /**
         * @deprecated
         */
        public function createPerson(string $feedId, string $userId, bool $post)
        {
            // TODO: use objects
            $role = 'default';

            if ($post) {
                $role = 'moderator';
            }

            $this->databaseBackend->execute(
                'INSERT INTO feed_users(feed_id, user_id, role) VALUES(:feed_id, :user_id, :role)',
                [
                    'feed_id' => $feedId,
                    'user_id' => $userId,
                    'role' => $role
                ]
            );
        }
    }
}
