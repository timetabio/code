<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Gateways
{
    use Timetabio\Framework\Curl\Credentials\BearerToken;
    use Timetabio\Frontend\Backends\ApiBackend;
    use Timetabio\Frontend\DataObjects\ApiResponse;
    use Timetabio\Frontend\Session\Session;

    class ApiGateway
    {
        /**
         * @var ApiBackend
         */
        private $apiBackend;

        /**
         * @var Session
         */
        private $session;

        /**
         * @var BearerToken
         */
        private $systemToken;

        public function __construct(ApiBackend $apiBackend, Session $session, BearerToken $systemToken)
        {
            $this->apiBackend = $apiBackend;
            $this->session = $session;
            $this->systemToken = $systemToken;
        }

        public function createUser(string $email, string $username, string $password): ApiResponse
        {
            return $this->apiBackend->post(
                '/users',
                [
                    'email' => $email,
                    'username' => $username,
                    'password' => $password
                ],
                $this->systemToken
            );
        }

        public function verifyUser(string $token): ApiResponse
        {
            return $this->apiBackend->post(
                '/verify',
                [
                    'token' => $token
                ],
                $this->systemToken
            );
        }

        public function getUser(): ApiResponse
        {
            return $this->apiBackend->get('/user', [], $this->getAccessToken());
        }

        public function getUserFeeds(int $limit, int $page): ApiResponse
        {
            return $this->apiBackend->get(
                '/user/feeds',
                [
                    'limit' => $limit,
                    'page' => $page
                ],
                $this->getAccessToken()
            );
        }

        public function authenticate(string $user, string $password): ApiResponse
        {
            return $this->apiBackend->post(
                '/auth',
                [
                    'user' => $user,
                    'password' => $password,
                    'scopes' => '*',
                    'auto_renew' => 'true'
                ],
                $this->systemToken
            );
        }

        public function resendVerification(string $email): ApiResponse
        {
            return $this->apiBackend->post('/verify/resend', ['email' => $email], $this->systemToken);
        }

        public function createFeed(string $name, string $description, bool $isPrivate): ApiResponse
        {
            return $this->apiBackend->post(
                '/feeds',
                [
                    'name' => $name,
                    'description' => $description,
                    'is_private' => $isPrivate ? 'true' : 'false'
                ],
                $this->getAccessToken()
            );
        }

        public function getFeed(string $feedId): ApiResponse
        {
            return $this->apiBackend->get('/feeds/' . urlencode($feedId), [], $this->getAccessToken());
        }

        public function getFeedPosts(string $feedId, int $limit, int $page): ApiResponse
        {
            return $this->apiBackend->get(
                '/feeds/' . urlencode($feedId) . '/posts',
                ['limit' => $limit, 'page' => $page],
                $this->getAccessToken()
            );
        }

        public function createNote(string $feedId, string $title, string $body, array $attachments): ApiResponse
        {
            return $this->apiBackend->post(
                '/feeds/' . urlencode($feedId) . '/posts',
                [
                    'type' => 'note',
                    'title' => $title,
                    'body' => $body,
                    'attachments' => $attachments
                ],
                $this->getAccessToken()
            );
        }

        public function archivePost(string $postId): ApiResponse
        {
            return $this->apiBackend->post(
                '/posts/' . urlencode($postId) . '/archive',
                [],
                $this->getAccessToken()
            );
        }

        public function followFeed(string $feedId): ApiResponse
        {
            return $this->apiBackend->post(
                '/feeds/' . urlencode($feedId) . '/follow',
                [],
                $this->getAccessToken()
            );
        }

        public function unfollowFeed(string $feedId): ApiResponse
        {
            return $this->apiBackend->post(
                '/feeds/' . urlencode($feedId) . '/unfollow',
                [],
                $this->getAccessToken()
            );
        }

        public function createUpload(string $filename, string $mimeType): ApiResponse
        {
            return $this->apiBackend->post(
                '/upload',
                [
                    'filename' => $filename,
                    'mime_type' => $mimeType
                ],
                $this->getAccessToken()
            );
        }

        public function getPost(string $postId): ApiResponse
        {
            return $this->apiBackend->get('/posts/' . urlencode($postId), [], $this->getAccessToken());
        }

        public function revokeToken(string $token): ApiResponse
        {
            return $this->apiBackend->post('/revoke', [], new BearerToken($token));
        }

        public function createBetaRequest(string $email): ApiResponse
        {
            return $this->apiBackend->post(
                '/beta_requests',
                [
                    'email' => $email
                ],
                $this->systemToken
            );
        }

        public function search(string $query, string $type): ApiResponse
        {
            return $this->apiBackend->get(
                '/search',
                [
                    'query' => $query,
                    'type' => $type
                ],
                $this->getAccessToken()
            );
        }

        public function getUserFeed(int $limit = 20, int $page = 1): ApiResponse
        {
            return $this->apiBackend->get(
                '/user/feed',
                [
                    'limit' => $limit,
                    'page' => $page
                ],
                $this->getAccessToken()
            );
        }

        public function getFeedInvitations(string $feedId): ApiResponse
        {
            return $this->apiBackend->get(
                '/feeds/' . urlencode($feedId) . '/invitations',
                [],
                $this->getAccessToken()
            );
        }

        public function getFeedUsers(string $feedId): ApiResponse
        {
            return $this->apiBackend->get(
                '/feeds/' . urlencode($feedId) . '/users',
                [],
                $this->getAccessToken()
            );
        }

        public function deleteFeedUser(string $feedId, string $userId): ApiResponse
        {
            return $this->apiBackend->delete(
                '/feeds/' . urlencode($feedId) . '/users/' . urlencode($userId),
                [],
                $this->getAccessToken()
            );
        }

        public function inviteFeedUser(string $feedId, string $username, string $role): ApiResponse
        {
            return $this->apiBackend->post(
                '/feeds/' . urlencode($feedId) . '/invitations',
                [
                    'username' => $username,
                    'role' => $role
                ],
                $this->getAccessToken()
            );
        }

        public function deleteFeedInvitation(string $feedId, string $userId): ApiResponse
        {
            return $this->apiBackend->delete(
                '/feeds/' . urlencode($feedId) . '/invitations/' . urlencode($userId),
                [],
                $this->getAccessToken()
            );
        }

        public function updateFeedUser(string $feedId, string $userId, string $role): ApiResponse
        {
            return $this->apiBackend->patch(
                '/feeds/' . urlencode($feedId) . '/users/' . urlencode($userId),
                [
                    'role' => $role
                ],
                $this->getAccessToken()
            );
        }

        public function updateFeedName(string $feedId, string $name): ApiResponse
        {
            return $this->apiBackend->patch(
                '/feeds/' . urlencode($feedId),
                [
                    'name' => $name
                ],
                $this->getAccessToken()
            );
        }

        public function updateFeedDescription(string $feedId, string $description): ApiResponse
        {
            return $this->apiBackend->patch(
                '/feeds/' . urlencode($feedId),
                [
                    'description' => $description
                ],
                $this->getAccessToken()
            );
        }

        public function updateFeedVanity(string $feedId, string $vanity): ApiResponse
        {
            return $this->apiBackend->patch(
                '/feeds/' . urlencode($feedId),
                [
                    'vanity' => $vanity
                ],
                $this->getAccessToken()
            );
        }

        protected function getAccessToken()
        {
            if (!$this->session->hasAccessToken()) {
                return null;
            }

            return new BearerToken($this->session->getAccessToken());
        }
    }
}
