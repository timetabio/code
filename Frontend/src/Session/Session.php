<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Session
{
    use Timetabio\Framework\Http\Request\RequestInterface;
    use Timetabio\Framework\Map\Map;
    use Timetabio\Framework\Map\MapInterface;
    use Timetabio\Framework\ValueObjects\Cookie;
    use Timetabio\Framework\ValueObjects\Token;
    use Timetabio\Frontend\DataObjects\User;
    use Timetabio\Frontend\DataStore\DataStoreReader;

    class Session
    {
        /**
         * @var DataStoreReader
         */
        private $dataStoreReader;

        /**
         * @var string
         */
        private $sessionId;

        /**
         * @var int
         */
        private $expires = 30 * 24 * 60 * 60;

        /**
         * @var MapInterface
         */
        private $data;

        /**
         * @var bool
         */
        private $isLoaded = false;

        public function __construct(DataStoreReader $dataStoreReader)
        {
            $this->dataStoreReader = $dataStoreReader;
        }

        public function getSessionId(): string
        {
            if ($this->sessionId === null) {
                $this->sessionId = (string) new Token;
            }

            return $this->sessionId;
        }

        public function getExpires(): int
        {
            return $this->expires;
        }

        public function getCrfsToken(): Token
        {
            $this->load();

            if (!$this->data->has('crfsToken')) {
                $this->data->set('crfsToken', new Token);
            }

            return $this->data->get('crfsToken');
        }

        public function setUser(User $user)
        {
            $this->load();

            $this->data->set('user', $user);
        }

        public function removeUser()
        {
            $this->load();

            $this->data->remove('user');
        }

        public function hasUser(): bool
        {
            $this->load();

            return $this->data->has('user');
        }

        public function getUser(): User
        {
            $this->load();

            return $this->data->get('user');
        }

        public function setAccessToken(string $accessToken)
        {
            $this->load();
            $this->data->set('accessToken', $accessToken);
        }

        public function hasAccessToken(): bool
        {
            $this->load();

            return $this->data->has('accessToken');
        }

        public function getAccessToken(): string
        {
            $this->load();

            return $this->data->get('accessToken');
        }

        public function removeAccessToken()
        {
            $this->load();

            $this->data->remove('accessToken');
        }

        public function getCookie(): Cookie
        {
            return new Cookie('session_id', $this->getSessionId(), '/', time() + $this->expires);
        }

        public function getData(): MapInterface
        {
            $this->load();

            return $this->data;
        }

        public function loadRequest(RequestInterface $request)
        {
            if (!$request->hasCookie('session_id')) {
                return;
            }

            $sessionId = $request->getCookie('session_id');

            if (!$this->dataStoreReader->hasSessionData($sessionId)) {
                return;
            }

            $this->sessionId = $sessionId;
        }

        public function renewSessionId(): void
        {
            $this->sessionId = new Token;
        }

        private function load()
        {
            if ($this->isLoaded) {
                return;
            }

            $this->data = $this->loadData();
            $this->isLoaded = true;
        }

        private function loadData(): MapInterface
        {
            if ($this->sessionId === null) {
                return new Map;
            }

            if (!$this->dataStoreReader->hasSessionData($this->sessionId)) {
                return new Map;
            }

            return $this->dataStoreReader->getSessionData($this->sessionId);
        }
    }
}
