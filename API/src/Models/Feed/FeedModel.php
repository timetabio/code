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
    use Timetabio\API\Models\APIModel;
    use Timetabio\API\ValueObjects\FeedId;

    class FeedModel extends APIModel
    {
        /**
         * @var FeedId
         */
        private $feedId;

        public function getFeedId(): FeedId
        {
            return $this->feedId;
        }

        public function setFeedId(FeedId $feedId)
        {
            $this->feedId = $feedId;
        }
    }
}
