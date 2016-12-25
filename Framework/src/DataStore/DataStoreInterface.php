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
    use Timetabio\Framework\Map\ReadableMapInterface;
    use Timetabio\Framework\Map\WritableMapInterface;

    interface DataStoreInterface extends WritableMapInterface
    {
        public function setTimeout(string $key, int $ttl);

        public function removeTimeout(string $key);

        public function push(string $key, $value);

        public function pop(string $key);

        public function addToSet(string $key, string $value);

        public function removeFromSet(string $key, string $value);

        public function hasInSet(string $key, string $value): bool;

        public function setInHash(string $hash, string $key, string $value);

        public function getFromHash(string $hash, string $key);

        public function hasInHash(string $hash, string $key);

        public function removeFromHash(string $hash, string $key);

        public function zLpop(string $key);

        public function zAdd(string $key, int $score, string $value);

        public function has(string $key): bool;

        public function get(string $key): ?string;

        public function sCard(string $key): int;
    }
}
