<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Frontend\Models\Page
{
    use Timetabio\Frontend\ValueObjects\PaginatedResult;

    class FeedPostsPageModel extends FeedPageModel
    {
        /**
         * @var PaginatedResult
         */
        private $feedPosts;

        public function getFeedPosts(): PaginatedResult
        {
            return $this->feedPosts;
        }

        public function setFeedPosts(PaginatedResult $feedPosts)
        {
            $this->feedPosts = $feedPosts;
        }
    }
}
