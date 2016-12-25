<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Models
{
    trait UpdateModelTrait
    {
        /**
         * @var array
         */
        private $updates = [];

        public function hasUpdates(): bool
        {
            return count($this->updates);
        }

        public function getUpdates(): array
        {
            return $this->updates;
        }

        public function hasUpdate(string $field): bool
        {
            return isset($this->updates[$field]);
        }

        public function getUpdate(string $field)
        {
            return $this->updates[$field];
        }

        public function addUpdate(string $field, $value)
        {
            $this->updates[$field] = $value;
        }
    }
}
