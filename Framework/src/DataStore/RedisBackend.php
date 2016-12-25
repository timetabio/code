<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\DataStore
{
    class RedisBackend implements DataStoreInterface
    {
        /**
         * @var \Redis
         */
        private $redis;

        /**
         * @var string
         */
        private $redisHost;

        /**
         * @var int
         */
        private $redisPort;

        public function __construct(\Redis $redis, string $redisHost, int $redisPort)
        {
            $this->redis = $redis;
            $this->redisHost = $redisHost;
            $this->redisPort = $redisPort;
        }

        public function has(string $key): bool
        {
            $this->connect();

            return $this->redis->exists($key);
        }

        public function get(string $key): ?string
        {
            $this->connect();

            return $this->redis->get($key);
        }

        public function set(string $key, $value)
        {
            $this->connect();

            $this->redis->set($key, $value);
        }

        public function remove(string $key)
        {
            $this->connect();

            $this->redis->delete($key);
        }

        public function setTimeout(string $key, int $ttl)
        {
            $this->connect();

            $this->redis->expire($key, $ttl);
        }

        public function removeTimeout(string $key)
        {
            $this->connect();

            $this->redis->persist($key);
        }

        public function pop(string $key)
        {
            $this->connect();

            return $this->redis->rPop($key);
        }

        public function push(string $key, $value)
        {
            $this->connect();

            $this->redis->lPush($key, $value);
        }

        public function addToSet(string $key, string $value)
        {
            $this->connect();

            $this->redis->sAdd($key, $value);
        }

        public function hasInSet(string $key, string $value): bool
        {
            $this->connect();

            return $this->redis->sIsMember($key, $value);
        }

        public function removeFromSet(string $key, string $value)
        {
            $this->connect();

            return $this->redis->sRem($key, $value);
        }

        public function setInHash(string $hash, string $key, string $value)
        {
            $this->connect();

            $this->redis->hSet($hash, $key, $value);
        }

        public function getFromHash(string $hash, string $key)
        {
            $this->connect();

            return $this->redis->hGet($hash, $key);
        }

        public function hasInHash(string $hash, string $key): bool
        {
            $this->connect();

            return $this->redis->hExists($hash, $key);
        }

        public function removeFromHash(string $hash, string $key)
        {
            $this->connect();

            $this->redis->hDel($hash, $key);
        }

        public function zLpop(string $key)
        {
            $this->connect();

            $result = $this->redis->multi()
                ->zRange($key, 0, 0)
                ->zRemRangeByRank($key, 0, 0)
                ->exec();

            if (!isset($result[0][0])) {
                return null;
            }

            return $result[0][0];
        }

        public function zAdd(string $key, int $score, string $value)
        {
            $this->connect();

            $this->redis->zAdd($key, $score, $value);
        }

        public function sCard(string $key): int
        {
            $this->connect();

            return $this->redis->sCard($key);
        }

        private function connect()
        {
            if ($this->redis->isConnected()) {
                return;
            }

            $this->redis->connect($this->redisHost, $this->redisPort);
        }
    }
}
