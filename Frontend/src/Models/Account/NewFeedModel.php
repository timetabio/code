<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Models\Account
{
    use Timetabio\Frontend\Models\ActionModel;

    class NewFeedModel extends ActionModel
    {
        /**
         * @var string
         */
        private $feedName;

        /**
         * @var string
         */
        private $feedDescription;

        /**
         * @var bool
         */
        private $feedIsPrivate;

        public function getFeedName(): string
        {
            return $this->feedName;
        }

        public function setFeedName(string $feedName)
        {
            $this->feedName = $feedName;
        }

        public function getFeedDescription(): string
        {
            return $this->feedDescription;
        }

        public function setFeedDescription(string $feedDescription)
        {
            $this->feedDescription = $feedDescription;
        }

        public function getFeedIsPrivate(): bool
        {
            return $this->feedIsPrivate;
        }

        public function setFeedIsPrivate(bool $feedIsPrivate)
        {
            $this->feedIsPrivate = $feedIsPrivate;
        }
    }
}
