<?php
/**
 * (c) 2016 Ruben Schmidmeister
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
