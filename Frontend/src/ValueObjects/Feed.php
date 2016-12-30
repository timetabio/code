<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\ValueObjects
{
    class Feed
    {
        /**
         * @var Feed
         */
        private $feed;

        public function __construct(array $feed)
        {
            $this->feed = $feed;
        }

        public function getId(): string
        {
            return $this->feed['id'];
        }

        public function getName(): string
        {
            return $this->feed['name'];
        }

        public function hasDescription(): bool
        {
            return !empty($this->feed['description']);
        }

        public function getDescription(): string
        {
            return $this->feed['description'];
        }

        public function getVanity(): ?string
        {
            return isset($this->feed['vanity']) ? $this->feed['vanity'] : null;
        }

        public function hasPostAccess(): bool
        {
            return isset($this->feed['access']['post']) && $this->feed['access']['post'];
        }

        public function hasUsersManageAccess(): bool
        {
            return isset($this->feed['access']['manage_users']) && $this->feed['access']['manage_users'];
        }

        public function hasEditAccess(): bool
        {
            return isset($this->feed['access']['edit']) && $this->feed['access']['edit'];
        }

        public function isUserInvited(): bool
        {
            return isset($this->feed['user']['invited']) && $this->feed['user']['invited'];
        }

        public function isVerified(): bool
        {
            return isset($this->feed['is_verified']) && $this->feed['is_verified'];
        }

        public function hasUserAdded(): bool
        {
            return isset($this->feed['user']['has_added']) && $this->feed['user']['has_added'];
        }

        public function canUserUnfollow(): bool
        {
            return isset($this->feed['user']['can_unfollow']) && $this->feed['user']['can_unfollow'];
        }

        public function isPrivate(): bool
        {
            return isset($this->feed['is_private']) && $this->feed['is_private'];
        }

        public function isPublic(): bool
        {
            return !$this->isPrivate();
        }

        /**
         * @return array
         * @deprecated To be used until all renderers/snippets support passing in a `Feed` instead of an array
         */
        public function toArray(): array
        {
            return $this->feed;
        }
    }
}
