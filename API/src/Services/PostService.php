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
    use Timetabio\API\ValueObjects\Attachment;
    use Timetabio\Framework\Backends\PostgresBackend;
    use Timetabio\Framework\ValueObjects\Timestamp;
    use Timetabio\Library\PostTypes\PostTypeInterface;

    class PostService
    {
        /**
         * @var PostgresBackend
         */
        private $databaseBackend;

        public function __construct(PostgresBackend $databaseBackend)
        {
            $this->databaseBackend = $databaseBackend;
        }

        public function getPostForUser(string $postId, string $userId)
        {
            // TODO: move mapping of is_checked to mapper (only return is_checked for tasks)
            return $this->databaseBackend->fetch(
                'SELECT post.*, coalesce(annotation.is_checked, FALSE) AS is_checked
                 FROM aggregated_posts AS post
                 LEFT OUTER JOIN post_annotations AS annotation
                   ON post.id = annotation.post_id
                   AND annotation.user_id = :user_id
                 WHERE post.id = :post_id',
                [
                    'post_id' => $postId,
                    'user_id' => $userId
                ]
            );
        }

        public function getPost(string $postId)
        {
            // TODO: move mapping of is_checked to mapper (only return is_checked for tasks)
            return $this->databaseBackend->fetch(
                'SELECT post.*
                 FROM aggregated_posts AS post
                 WHERE post.id = :post_id',
                [
                    'post_id' => $postId
                ]
            );
        }

        public function getPostInfo(string $postId)
        {
            return $this->databaseBackend->fetch('SELECT id, feed_id, author_id, archived FROM posts WHERE id = :id', [
                'id' => $postId
            ]);
        }

        public function getPosts(string $feedId, int $limit, int $page): array
        {
            return $this->databaseBackend->fetchAll(
                'SELECT *
                 FROM aggregated_posts AS posts
                 WHERE posts.feed_id = :feed_id
                 LIMIT :limit
                 OFFSET :offset',
                [
                    'feed_id' => $feedId,
                    'limit' => $limit,
                    'offset' => $limit * ($page - 1)
                ]
            );
        }

        public function getPostsForUser(string $feedId, string $userId, int $limit, int $page): array
        {
            // TODO: move mapping of is_checked to mapper (only return is_checked for tasks)
            return $this->databaseBackend->fetchAll(
                'SELECT post.*, coalesce(annotation.is_checked, FALSE) AS is_checked
                 FROM aggregated_posts AS post
                 LEFT OUTER JOIN post_annotations AS annotation
                   ON post.id = annotation.post_id
                   AND annotation.user_id = :user_id
                 WHERE post.feed_id = :feed_id
                 LIMIT :limit
                 OFFSET :offset',
                [
                    'feed_id' => $feedId,
                    'user_id' => $userId,
                    'limit' => $limit,
                    'offset' => $limit * ($page - 1)
                ]
            );
        }

        public function getTodoTasks(string $userId, int $limit, int $page): array
        {
            return $this->databaseBackend->fetchAll(
                'SELECT * FROM uncompleted_tasks
                 WHERE user_id = :user_id
                 LIMIT :limit
                 OFFSET :offset',
                [
                    'user_id' => $userId,
                    'limit' => $limit,
                    'offset' => $limit * ($page - 1)
                ]
            );
        }

        public function getUpcomingEvents(string $userId, int $limit, int $page): array
        {
            return $this->databaseBackend->fetchAll(
                'SELECT * FROM upcoming_events
                 WHERE user_id = :user_id
                 LIMIT :limit
                 OFFSET :offset',
                [
                    'user_id' => $userId,
                    'limit' => $limit,
                    'offset' => $limit * ($page - 1)
                ]
            );
        }

        public function createPost(
            PostTypeInterface $type,
            string $feedId,
            string $authorId,
            string $title,
            string $body,
            Timestamp $timestamp = null): array
        {
            $stringTimestamp = new \Timetabio\Framework\Pdo\Value\NullValue;

            if ($timestamp !== null) {
                $stringTimestamp = (string) $timestamp;
            }

            return $this->databaseBackend->insert(
                'INSERT INTO posts (type, feed_id, author_id, title, body, timestamp) 
                 VALUES (:type, :feed_id, :author_id, :title, :body, :timestamp)
                 RETURNING *',
                [
                    'type' => (string) $type,
                    'feed_id' => $feedId,
                    'author_id' => $authorId,
                    'title' => $title,
                    'body' => $body,
                    'timestamp' => $stringTimestamp
                ]
            );
        }

        public function createAttachment(string $postId, Attachment $attachment)
        {
            return $this->databaseBackend->fetch(
                'INSERT INTO post_attachments (post_id, file_id) VALUES (:post_id, :file_id) RETURNING *',
                [
                    'post_id' => $postId,
                    'file_id' => $attachment->getFileId()
                ]
            );
        }

        public function getPostAttachments(string $postId)
        {
            return $this->databaseBackend->fetchAll(
                'SELECT files.public_id, files.name as filename, files.mime_type
                 FROM post_attachments
                 JOIN files ON post_attachments.file_id = files.id
                 WHERE post_attachments.post_id = :post_id',
                [
                    'post_id' => $postId
                ]
            );
        }

        public function archivePost(string $postId): string
        {
            return $this->databaseBackend->fetchColumn(
                'UPDATE posts SET archived = utc_now()
                 WHERE id = :id
                 RETURNING archived',
                [
                    'id' => $postId
                ]
            );
        }

        public function restorePost(string $postId): void
        {
            $this->databaseBackend->execute(
                'UPDATE posts SET archived = NULL
                 WHERE id = :id',
                [
                    'id' => $postId
                ]
            );
        }

        public function deletePost(string $postId)
        {
            $this->databaseBackend->execute('DELETE FROM posts WHERE id = :id', [
                'id' => $postId
            ]);
        }
    }
}
