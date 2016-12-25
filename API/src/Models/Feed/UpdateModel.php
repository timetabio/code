<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\API\Models\Feed
{
    use Timetabio\API\Models\UpdateModelTrait;

    class UpdateModel extends FeedModel
    {
        use UpdateModelTrait;

        /**
         * @var string
         */
        private $feedVanity;

        public function hasFeedVanity(): bool
        {
            return $this->feedVanity !== null;
        }

        public function getFeedVanity(): string
        {
            return $this->feedVanity;
        }

        public function setFeedVanity(string $feedVanity)
        {
            $this->feedVanity = $feedVanity;
        }
    }
}
