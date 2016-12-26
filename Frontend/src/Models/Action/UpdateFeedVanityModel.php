<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Models\Action
{
    use Timetabio\Frontend\Models\ActionModel;

    class UpdateFeedVanityModel extends ActionModel
    {
        /**
         * @var string
         */
        private $feedId;

        /**
         * @var string
         */
        private $feedVanity;

        public function getFeedId(): string
        {
            return $this->feedId;
        }

        public function setFeedId(string $feedId)
        {
            $this->feedId = $feedId;
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
