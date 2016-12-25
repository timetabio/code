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
    use Timetabio\Frontend\Models\PageModel;
    use Timetabio\Frontend\Tabs\FeedPage\FeedPageTab;
    use Timetabio\Frontend\Tabs\Tab;
    use Timetabio\Frontend\ValueObjects\Feed;

    abstract class FeedPageModel extends PageModel
    {
        /**
         * @var Feed
         */
        private $feed;

        public function __construct(Feed $feed)
        {
            $this->feed = $feed;
        }

        public function getFeed(): Feed
        {
            return $this->feed;
        }

        public function getTitle(): string
        {
            return $this->feed->getName();
        }

        abstract public function getActiveTab(): Tab;
    }
}
